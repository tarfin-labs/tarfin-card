<div align="center">

<a href="https://tarfin.com" target="_blank">
    <img src=".github/logo.svg" height="100">
</a>

</div>

<div align="center">

## TarfinKart Problemi

</div>

Bu problemin ana hedefi, senin kodlama stilini, tercihlerini anlayabilmemize ve aynı zamanda tecrübelerini ve
yeteneklerini sergilemene/ortaya çıkarmana imkan tanımaktır.

TarfinKart Problemi, devrim niteliğinde çözümler geliştirmenizi ya da en son teknoloji araçları kullanmanızı
gerektirmez; asıl odak noktamız tam da bu: Kodlama tarzına odaklanarak temelde neler yapabileceğini görmek istiyoruz.

Bu nedenle, bu problemde "doğru" veya "yanlış" gibi kesin kavramlar yoktur ve "hileli bölümler" ya da "kelime oyunları"
gibi şeyler de bulunmamaktadır. Asıl amacımız, kod yazma tarzını daha iyi anlamaktır.

Bu yaklaşım, daha samimi ve verimli teknik görüşmeler gerçekleştirmemizi sağlar. Beyaz tahta kullanarak mülakat yapmayı
sevmiyoruz, bu yüzden somut kod örnekleri üzerinden tartışmayı tercih ediyoruz. Bu sayede teknik mülakatların çok daha
keyifli ve başarılı geçeceğine inanıyoruz.

Herhangi bir sorunuz mu var? Bize yazarak bu görevi daha da geliştirmemize katkıda bulunabilirsin. Yardımcı olmak bizim
için bir zevktir 🙂.

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
- Sabit değerler (`Constants`) için ayrı sınıflar (`Enums`)

**ÖNEMLİ:** Bu problemi çözmek için Unit test dosyalarında değişiklik **yapmamalısın**. Sadece Unit testlerin başarıyla
geçmesi için gerekli kodu yazmalısın.

---

### Geliştirme Ortamının Hazırlanması

Bu bir **Laravel 9** projesidir ve **PHP 8.1+** gerektirir.

1. Kişisel GitHub hesabında `tarfin-card` isimli `private` bir `repo` oluştur.
2. GitHub hesabındaki `tarfin-card` `repo`sunu açtığında en alttaki `Import code` düğmesini göreceksin.   
   Bu özelliği kullanarak `https://github.com/tarfin-labs/tarfin-card` adresindeki `repo`yu `import` et.
3. `Private repo`'nu inceleyebilmemiz için, şu GitHub kullanıcılarını `Settings->Collaborators->Manage access->Add People` ile davet et:   
   `frkcn`, `deligoez`, `hozdemir`, `tkaratug`
5. `.env.example` dosyasından yeni bir `.env` dosyası oluştur.    
   `cp .env.example .env`
6. Bir sqlite veritabanı dosyası oluştur.  
   `touch database/database.sqlite`
7. Composer paketlerini yükle.  
   `composer install`
8. Laravel için bir `application key` oluştur.  
   `php artisan key:generate`
9. Veritabanı `migration`'larını çalıştır.  
   `php artisan migrate`
10. `Authentication` işlemleri için Laravel Passport'u ayarla.  
    `php artisan passport:install`
11. Yaptığın değişikliklerin [atomik](https://en.wikipedia.org/wiki/Atomic_commit) olmasına dikkat et.
12. En fazla 15dk'da bir `commit`'le.
13. Tüm testler geçiyor mu diye kontrol et ✅  
    `php artisan test`

