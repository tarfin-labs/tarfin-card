<div align="center">

<a href="https://tarfin.com" target="_blank">
    <img src=".github/logo.svg" height="100">
</a>

</div>

<div align="center">

## Card Challenge

</div>

This challenge's main purpose is to determine your coding style and choices.

The `Tarfin Card Challenge` does not include any unique or cutting-edge technology, tools, or other elements, which is precisely the point: we want to focus on your coding style rather than get sidetracked.

On that note, there are no "rights and wrongs" in this challenge, and there are no "trick portions." We simply want to get a better understanding of how you develop code.

This also allows us to have a more meaningful and positive technical interview discussion. We don't like white-boarding in interviews, so having some concrete code to discuss would be preferable. That, we believe, makes the interview lot more entertaining and fruitful.

Got problems? Help us improve this code challenge by writing to us. We’re happy to help 🙂

### Test #01

#### Objective

Create feature tests to test `TarfinCard` and `TarfinCardTransaction` endpoints and their relative policies, validations
and resources.

#### Business Logic

- Each customer can have multiple `TarfinCard`s and each `TarfinCard` can have many `TarfinCardTransaction`s.
- A customer should be able to create, update, read, list, and delete his `TarfinCard`s.
- For each `TarfinCard`, the customer should be able to list, read and create `TarfinCardTransaction`.

#### Challenge

Read through the *TarfinCard* and *TarfinCardTransaction* routes, controllers, requests, resources, and policies.
Understand the logic and write as many tests as possible to validate the endpoints. The `TarfinCardControllerTest`
and `TarfinCardTransactionControllerTest` are already created, you just need to complete them.

#### Tips

- Verify positive and negative scenarios
- Assert response and database values
- Customer can handle only his `TarfinCard`s

**IMPORTANT:** For this challenge you `SHOULD ONLY` update the feature tests.

---

### Test #02

#### Objective

Create a `LoanService` to handle repayments based on complete unit tests that have already been created for you.

#### Business Logic

Each customer can have a credit `Loan` (due in 3 or 6 months). So a `Loan` has 3 or 6 `ScheduledRepayment`s (once each
month), and it can be repaid with `ReceivedRepayment`s. Example:

`Loan` of 3 months with amount 3000$, created on 2021-01-01

- Scheduled Repayment of 1000$ due to 2021-02-01
- Scheduled Repayment of 1000$ due to 2021-03-01
- Scheduled Repayment of 1000$ due to 2021-04-01

A customer can repay the full amount of each single `ScheduledRepayment`, but also can repay partially or in full.

#### Challenge

Read through the tests of `LoanService` to understand what is the logic to be implemented. To make the unit tests passed, you need to fulfill:

- Models, Factories, Migrations for `Loan`, `ReceivedRepayment`, and `ScheduledRepayment`
- Loan Service;
- Exceptions
- Separate classes for constants

**IMPORTANT:** For this challenge you `SHOULD NOT` update the unit test.

---

### Setup procedure

1. Fork the repository in your personal GitHub account
2. Checkout a new feature branch from `main`
3. Copy the example .env file    
   `cp .env.example .env`
4. Install composer dependencies  
   `composer install`
5. Create sqlite database file  
   `touch database/database.sqlite`
6. Generate appliation key
   `php artisan key:generate`
7. Make your changes in each [commit atomic](https://en.wikipedia.org/wiki/Atomic_commit)
8. Check if the tests are green ✅  
   `php artisan test`
10. Push the code and prepare the Pull Request from feature branch to `main` branch