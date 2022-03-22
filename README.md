<div align="center">

<a href="https://tarfin.com" target="_blank">
    <img src=".github/logo.svg" height="100">
</a>

</div>

<div align="center">

## TarfinKart Problemi

</div>

Bu problemin temel amacı, kodlama stilini ve seçimlerini belirleyebilmektir.

`TarfinKart Problemi` benzeri görülmemiş bir çözüm geliştirmeyi veya son teknoloji araçları kullanabilmeyi gerektirmiyor
ve istediğimiz tam olarak da bu: yoldan sapmak yerine kodlama stiline odaklanmak istiyoruz.

Bu bağlamda; problem içinde "doğrular veya yanlışlar" yoktur. "Hileli kısımlar veya kelime oyuları" da yoktur. Sadece
nasıl kod geliştirdiğini daha iyi anlamak istiyoruz.

Bu aynı zamanda daha anlamlı ve olumlu bir teknik görüşme yapmamızı sağlar. Mülakatlarda beyaz tahta kullanmaktan
hoşlanmıyoruz, bu nedenle tartışacak bazı somut kodlara sahip olmayı tercih ederiz. Böylece yapacağımız teknik mülakatın
çok daha eğlenceli ve verimli hale geleceğine inanıyoruz.

Soruların mı var? Bize yazarak bu problemi geliştirmemize yardımcı olabilirsin. Sana yardımcı olmaktan mutluluk
duyarız 🙂.

### Problem #01

Bu problemde Tarfin'in müşterilerine kredi kartı benzeri bir **Kart** (`TarfinCard`) verdiğini ve müşterilerin bu kartlarla
çeşitli finansal işlemler (`TarfinCardTransaction`) yapabildiğini varsayıyoruz.

#### Amaç

`TarfinCard` ve `TarfinCardTransaction` API'lerini ve bunlara ait `Policy`'leri, `Validation`'ları ve `Resource`'ları
test etmek için `Feature Test`'ler oluştur.

#### Uygulama Detayları

- Her müşterinin birden fazla `TarfinCard`ı olabilir ve her `TarfinCard`ın birden fazla `TarfinCardTransaction`ı olabilir.
- Müşteriler kendi `TarfinCard`larını oluşturabilmeli, güncelleyebilmeli, görebilmeli, listeleyebilmeli ve silebilmelidir.
- Müşteriler her bir `TarfinCard`'a ait `TarfinCardTransaction`ınlarını listeleyebilmeli, görebilmeli ve oluşturabilmelidir.

#### Sorgula

**TarfinCard** ve **TarfinCardTransaction** `route`'larını, `controller`'larını, `request`'lerini, `resource`'
larını, `policy`'lerini baştan sona okuyup incele. Nasıl çalıştığını anlamaya çalış ve bu `API`'leri test etmek için
mümkün olduğunca çok test yaz.

`TarfinCardControllerTest` ve `TarfinCardTransactionControllerTest` Feature test dosyaları senin için zaten oluşturuldu.
İçinde fikir vermesi açısından örnek test isimleri var. Sadece testleri tamamlaman ve gerekli gördüğün yeni testler
yazman gerekiyor.

#### İpuçları

- Olumlu ve olumsuz senaryoları doğrula
- `API`'den dönen cevapları ve veritabanına kaydedilen değerleri doğrula
- Müşteri sadece kendi `TarfinCard`'ı ile işlem yapabilir.

**ÖNEMLİ:** Bu problemi çözmek için **SADECE** `Feature Test` dosyalarında değişiklik yapabilirsin.

---

### PROBLEM #02

#### Amaç

Geri ödemeleri yönetmek üzere bir **Borç Servisi** (`LoanService`) oluştur. Bu servisi yazarken, halihazırda senin için
yazılmış olan, `Unit` testlerini baz almalısın.

#### Uygulama Detayları

- Her müşterinin bir veya daha fazla **Borcu** (`Loan`) olabilir.
- Bu **Borç**lar (`Loan`) 3 veya 6 aylık olarak taksitlendirilebilir ve bu vadelere ait **Planlanmış Geri Ödeme**leri (`ScheduledRepayment`) bulunur.
- **Borç**lar **Alınan Ödeme**ler (`ReceivedRepayment`) ile geri ödenir.

Örneğin:

2022-01-01 tarihinde oluşturulmuş 3000TL tutarındaki 3 taksitli **Borç**

- 2022-02-01 tarihinde 1000 TL'lik bir **Planlanmış Geri Ödeme** (`ScheduledRepayment`)
- 2022-03-01 tarihinde 1000 TL'lik bir **Planlanmış Geri Ödeme** (`ScheduledRepayment`)
- 2022-04-01 tarihinde 1000 TL'lik bir **Planlanmış Geri Ödeme** (`ScheduledRepayment`)

Müşteri her bir **Planlanmış Geri Ödeme** (`ScheduledRepayment`) tutarının tamamını geri ödeyebilir. Fakat isterse
**Planlanmış Geri Ödeme** (`ScheduledRepayment`) tutarının sadece bir kısmını veya vadesi gelmemiş olsa bile, borcunun
tamamını ödeyebilir.

#### Sorgula

Nasıl çalışması gerektiğini anlamak için `LoanService` (**Borç Servisi**) Unit testlerini iyice oku. Testlerin başarılı bir
şekilde çalışabilmesi için yapman gerekenler arasında şunlar olabilir:

- `Loan`, `ReceivedRepayment` ve `ScheduledRepayment` Modelleri için `Factory`ler ve `Migration`lar
- Borç Servisi (`LoanService`)
- `Exception`lar
- Sabit değerler (`constants`) için ayrı sınıflar (`classes`)

**ÖNEMLİ:** Bu problemi çözmek için Unit test dosyalarında değişiklik **yapmamalısın**. Sadece Unit testlerin başarıyla
geçmesi için gerekli kodu yazmalısın.

---

### Geliştirme Ortamının Hazırlanması

1. Bu `Repo`'yu kişisel GitHub hesabına `fork`'la.
2. `main` `branch`'inden yeni bir `feature branch`'i oluştur (`checkout`).
3. `.env.example` dosyasından yeni bir `.env` dosyası oluştur.    
   `cp .env.example .env`
4. Composer paketlerini yükle.  
   `composer install`
5. Bir sqlite veritabanı dosyası oluştur.  
   `touch database/database.sqlite`
6. Laravel için bir `application key` oluştur.
   `php artisan key:generate`
7. Yaptığın değişikliklerin (`commit`) [atomik](https://en.wikipedia.org/wiki/Atomic_commit) olmasına dikkat et.
8. En fazla 15dk'da bir `commit`'le.
9. Tüm testler geçiyor mu diye kontrol et ✅  
   `php artisan test`
10. Kodlarını gönder (`push`) ve `feature brach`'inden yeni bir `Pull Request` oluştur ve bizi haberdar et.

---

<div align="center">

## TarfinCard Challenge

</div>

<details>
   <summary>Click to expand</summary>

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
- Assert response, status, and database values
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
4. Create sqlite database file  
   `touch database/database.sqlite`
5. Install composer dependencies  
   `composer install`
6. Generate appliation key
   `php artisan key:generate`
7. Make your changes in each [commit atomic](https://en.wikipedia.org/wiki/Atomic_commit)
8. Check if the tests are green ✅  
   `php artisan test`
9. Push the code and prepare the Pull Request from feature branch to `main` branch

</details>