<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Models\Loan;
use App\Models\User;
use App\Enums\CurrencyType;
use App\Facades\LoanFacade;
use App\Enums\PaymentStatus;
use Illuminate\Support\Carbon;
use App\Models\ReceivedRepayment;
use App\Models\ScheduledRepayment;
use PHPUnit\Framework\Attributes\Test;
use App\Exceptions\AlreadyRepaidException;
use PHPUnit\Framework\Attributes\DataProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Exceptions\AmountHigherThanOutstandingAmountException;

class LoanServiceTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    #[DataProvider('createLoanDataProvider')]
    public function can_create_loan_for_a_customer(
        int $terms,
        int $amount,
        CurrencyType $currencyCode,
        Carbon $processedAt,
        array $scheduledRepaymentAmounts
    ): void {
        // 1. Arrange
        $customer = User::factory()->create();

        // 2. Act
        $loan = LoanFacade::createLoan(
            customer: $customer,
            amount: $amount,
            currencyCode: $currencyCode,
            terms: $terms,
            processedAt: $processedAt
        );

        // 3. Assert
        $this->assertDatabaseHas(
            table: Loan::class,
            data: [
                'id'                 => $loan->id,
                'user_id'            => $customer->id,
                'amount'             => $amount,
                'terms'              => $terms,
                'outstanding_amount' => $amount,
                'currency_code'      => $currencyCode,
                'processed_at'       => $processedAt,
                'status'             => PaymentStatus::DUE,
            ]);

        $this->assertCount(
            expectedCount: $terms,
            haystack: $loan->scheduledRepayments
        );

        foreach ($loan->scheduledRepayments as $index => $scheduledRepayment) {
            $this->assertDatabaseHas(
                table: ScheduledRepayment::class,
                data: [
                    'loan_id'            => $loan->id,
                    'amount'             => $scheduledRepaymentAmounts[$index],
                    'outstanding_amount' => $scheduledRepaymentAmounts[$index],
                    'currency_code'      => $currencyCode,
                    'due_date'           => $processedAt->clone()->addMonths(value: $index + 1),
                    'status'             => PaymentStatus::DUE,
                ]);
        }

        $this->assertEquals(
            expected: $amount,
            actual: $loan->scheduledRepayments()->sum(column: 'amount')
        );
    }

    #[Test]
    public function can_pay_a_scheduled_payment(): void
    {
        // 1. Arrange
        $customer = User::factory()->create();

        $loan = LoanFacade::createLoan(
            customer: $customer,
            amount: 5000,
            currencyCode: CurrencyType::TRY,
            terms: 3,
            processedAt: Carbon::parse(time: '2024-01-20'),
        );

        $receivedRepayment = 1666;
        $currencyCode      = CurrencyType::TRY;
        $receivedAt        = Carbon::parse(time: '2024-02-20');

        // 2. Act
        $loan = LoanFacade::repayLoan(
            loan: $loan,
            amount: $receivedRepayment,
            currencyCode: $currencyCode,
            receivedAt: $receivedAt
        );

        // 3. Assert

        // Asserting `Loan` values
        $this->assertDatabaseHas(
            table: Loan::class,
            data: [
                'id'                 => $loan->id,
                'user_id'            => $customer->id,
                'amount'             => 5000,
                'outstanding_amount' => 5000 - 1666,
                'currency_code'      => $currencyCode,
                'status'             => PaymentStatus::DUE,
                'processed_at'       => Carbon::parse(time: '2024-01-20'),
            ]);

        // Asserting the first `ScheduledRepayment` is repaid
        $this->assertDatabaseHas(
            table: ScheduledRepayment::class,
            data: [
                'loan_id'            => $loan->id,
                'amount'             => 1666,
                'outstanding_amount' => 0,
                'currency_code'      => $currencyCode,
                'due_date'           => Carbon::parse(time: '2024-02-20'),
                'status'             => PaymentStatus::REPAID,
            ]);

        // Asserting the second and the third `ScheduledRepayments` are still due
        $this->assertDatabaseHas(
            table: ScheduledRepayment::class,
            data: [
                'status'   => PaymentStatus::DUE,
                'due_date' => Carbon::parse(time: '2024-03-20'),
            ]);

        $this->assertDatabaseHas(
            table: ScheduledRepayment::class,
            data: [
                'status'   => PaymentStatus::DUE,
                'due_date' => Carbon::parse(time: '2024-04-20'),
            ]);

        // Asserting `ReceivedRepayment` values
        $this->assertDatabaseHas(
            table: ReceivedRepayment::class,
            data: [
                'loan_id'       => $loan->id,
                'amount'        => 1666,
                'currency_code' => $currencyCode,
                'received_at'   => $receivedAt,
            ]);
    }

    #[Test]
    public function can_pay_a_scheduled_payment_consecutively(): void
    {
        // 1. Arrange
        $customer = User::factory()->create();

        $loan = LoanFacade::createLoan(
            customer: $customer,
            amount: 5000,
            currencyCode: CurrencyType::TRY,
            terms: 3,
            processedAt: Carbon::parse(time: '2024-01-20'),
        );

        // The first two `ScheduledRepayments` are already repaid and the last one is due
        $loan->update(['outstanding_amount' => 5000 - (1666 * 2)]);

        foreach ($loan->scheduledRepayments->take(limit: 2) as $scheduledRepayment) {
            $scheduledRepayment->update([
                'status'             => PaymentStatus::REPAID,
                'outstanding_amount' => 0,
            ]);
        }

        $receivedRepayment = 1668;
        $currencyCode      = CurrencyType::TRY;
        $receivedAt        = Carbon::parse(time: '2024-04-20');

        // 2. Act
        // Repaying the last one
        $loan = LoanFacade::repayLoan(
            loan: $loan,
            amount: $receivedRepayment,
            currencyCode: $currencyCode,
            receivedAt: $receivedAt
        );

        // 3. Assert
        // Asserting the Loan values
        $this->assertDatabaseHas(
            table: Loan::class,
            data: [
                'id'                 => $loan->id,
                'user_id'            => $customer->id,
                'amount'             => 5000,
                'outstanding_amount' => 0,
                'currency_code'      => $currencyCode,
                'status'             => PaymentStatus::REPAID,
                'processed_at'       => Carbon::parse(time: '2024-01-20'),
            ]);

        // Asserting Last `ScheduledRepayment` is repaid
        $this->assertDatabaseHas(
            table: ScheduledRepayment::class,
            data: [
                'loan_id'            => $loan->id,
                'amount'             => 1668,
                'outstanding_amount' => 0,
                'currency_code'      => $currencyCode,
                'due_date'           => Carbon::parse(time: '2024-04-20'),
                'status'             => PaymentStatus::REPAID,
            ]);

        // Asserting `ReceivedRepayment` values
        $this->assertDatabaseHas(
            table: ReceivedRepayment::class,
            data: [
                'loan_id'       => $loan->id,
                'amount'        => 1668,
                'currency_code' => $currencyCode,
                'received_at'   => Carbon::parse(time: '2024-04-20'),
            ]);
    }

    #[Test]
    public function can_pay_multiple_scheduled_payment(): void
    {
        // 1. Arrange
        $customer = User::factory()->create();

        $loan = LoanFacade::createLoan(
            customer: $customer,
            amount: 5000,
            currencyCode: CurrencyType::TRY,
            terms: 3,
            processedAt: Carbon::parse(time: '2024-01-20'),
        );

        // Paying more than the first `ScheduledRepayment` amount
        $receivedRepayment = 2000;
        $currencyCode      = CurrencyType::TRY;
        $receivedAt        = Carbon::parse(time: '2024-02-20');

        // 2. Act
        $loan = LoanFacade::repayLoan(
            loan: $loan,
            amount: $receivedRepayment,
            currencyCode: $currencyCode,
            receivedAt: $receivedAt
        );

        // 3. Assert
        // Asserting the `Loan` values
        $this->assertDatabaseHas(
            table: Loan::class,
            data: [
                'id'                 => $loan->id,
                'user_id'            => $customer->id,
                'amount'             => 5000,
                'outstanding_amount' => 5000 - 2000,
                'currency_code'      => $currencyCode,
                'status'             => PaymentStatus::DUE,
                'processed_at'       => Carbon::parse(time: '2024-01-20'),
            ]);

        // Asserting the first `ScheduledRepayment` is repaid
        $this->assertDatabaseHas(
            table: ScheduledRepayment::class,
            data: [
                'loan_id'            => $loan->id,
                'amount'             => 1666,
                'outstanding_amount' => 0,
                'currency_code'      => $currencyCode,
                'due_date'           => Carbon::parse(time: '2024-02-20'),
                'status'             => PaymentStatus::REPAID,
            ]);

        // Asserting the second `ScheduledRepayment` is partially repaid
        $this->assertDatabaseHas(
            table: ScheduledRepayment::class,
            data: [
                'loan_id'            => $loan->id,
                'amount'             => 1666,
                'outstanding_amount' => 1332, // 1666 - (2000 - 1666)
                'currency_code'      => $currencyCode,
                'due_date'           => Carbon::parse(time: '2024-03-20'),
                'status'             => PaymentStatus::PARTIAL,
            ]);

        // Asserting `ReceivedRepayment` values
        $this->assertDatabaseHas(
            table: ReceivedRepayment::class,
            data: [
                'loan_id'       => $loan->id,
                'amount'        => 2000,
                'currency_code' => $currencyCode,
                'received_at'   => Carbon::parse(time: '2024-02-20'),
            ]);
    }

    #[Test]
    public function can_not_pay_more_than_outstanding_amount(): void
    {
        // 1. Arrange
        $customer = User::factory()->create();

        $loan = LoanFacade::createLoan(
            customer: $customer,
            amount: 5000,
            currencyCode: CurrencyType::TRY,
            terms: 3,
            processedAt: Carbon::parse(time: '2024-01-20'),
        );

        // 3. Assert
        $this->expectException(exception: AmountHigherThanOutstandingAmountException::class);

        // 2. Act
        LoanFacade::repayLoan(
            loan: $loan,
            amount: 5001,
            currencyCode: CurrencyType::TRY,
            receivedAt: now()
        );
    }

    #[Test]
    public function can_not_pay_a_loan_if_already_repaid(): void
    {
        // 1. Arrange
        $loan = Loan::factory()->create([
            'status'             => PaymentStatus::REPAID,
            'outstanding_amount' => 0,
        ]);

        // 3. Assert
        $this->expectException(exception: AlreadyRepaidException::class);

        // 2. Act
        LoanFacade::repayLoan(
            loan: $loan,
            amount: 5001,
            currencyCode: CurrencyType::TRY,
            receivedAt: now()
        );
    }

    /**
     * DataProvider for test `can_create_loan_for_a_customer`.
     *
     * @return array<string, array<mixed>>
     */
    public static function createLoanDataProvider(): array
    {
        return [
            '5000TRY for 3 months'  => [3, 5000, CurrencyType::TRY, Carbon::now()->startOfMonth(), [1666, 1666, 1668]],
            '5000LEU for 6 months'  => [6, 5000, CurrencyType::LEU, Carbon::now()->startOfMonth(), [833, 833, 833, 833, 833, 835]],
            '12345EUR for 6 months' => [6, 12345, CurrencyType::EUR, Carbon::now()->startOfMonth(), [2057, 2057, 2057, 2057, 2057, 2060]],
            '4EUR for 3 months'     => [3, 4, CurrencyType::EUR, Carbon::now()->startOfMonth(), [1, 1, 2]],
        ];
    }
}
