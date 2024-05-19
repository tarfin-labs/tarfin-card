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
ve istediğimiz tam olarak da bu: Yoldan sapmak yerine kodlama stiline odaklanmak istiyoruz.

Bu bağlamda; problem içinde "doğrular veya yanlışlar" yoktur. "Hileli kısımlar veya kelime oyuları" da yoktur. Sadece
nasıl kod geliştirdiğini daha iyi anlamak istiyoruz.

Bu aynı zamanda daha anlamlı ve olumlu bir teknik görüşme yapmamızı sağlar. Mülakatlarda beyaz tahta kullanmaktan
hoşlanmıyoruz, bu nedenle tartışacak bazı somut kodlara sahip olmayı tercih ederiz. Böylece yapacağımız teknik mülakatın
çok daha eğlenceli ve verimli hale geleceğine inanıyoruz.

Problem üzerinde çalışırken, sahip olduğun tüm yetenekleri kullanmanı ve çözüm için çok özenli bir yaklaşım benimsemeni
rica ediyoruz.
Lütfen problemin gerektirdiği kadar zamanı mutlaka ayır ve tamamlamak için acele etme.
Bununla birlikte, gerektiğinde ek zaman talep etmekten de çekinme. Çözümde başarılı olman ve en iyi performansı
sergilemen bizim için önemlidir.

Soruların mı var? Bize yazarak bu problemi geliştirmemize yardımcı olabilirsin. Sana yardımcı olmaktan mutluluk
duyarız 🙂.

`TarfinKart Problemi`ni çözmek için ayırdığın zaman ve çaban için şimdiden teşekkürler.

Başarılar 🚀

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
- Yazman gereken test methodlarının [AAA (Arrange/Act/Assert)](https://medium.com/@prachishah03737/a-guide-to-phpunit-in-laravel-streamline-your-testing-workflow-efd56ae7726b) prensibine uygun olarak sıralandığına dikkat et

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

Bu bir **Laravel 11** projesidir ve **PHP 8.2 veya 8.3** gerektirir.

1. Kişisel GitHub hesabında `tarfin-card` isimli `private` bir `repo` oluştur
2. GitHub hesabındaki `tarfin-card` `repo`sunu açtığında en alttaki `Import code` düğmesini göreceksin   
   Bu özelliği kullanarak `https://github.com/tarfin-labs/tarfin-card` adresindeki `repo`yu `import` et
3. `Private repo`'nu inceleyebilmemiz için, şu GitHub kullanıcılarını `Settings->Collaborators->Manage access->Add People` ile davet et      
   `frkcn`, `deligoez`, `tkaratug`, `aydinfatih`, `yidemir`
4. Composer paketlerini yükle
   ```shell
   composer install
    ```
5. Testleri çalıştırmak için gerekli olan bir `application key` oluştur
   ```shell
   php artisan key:generate --env=testing
    ```
6. Laravel Passport'u şifreleme anahtarlarını oluştur
   ```shell
   php artisan passport:keys
    ```
7. Yaptığın değişikliklerin [atomik](https://en.wikipedia.org/wiki/Atomic_commit) olmasına dikkat et
8. En fazla 15dk'da bir `commit`'le
9. Tüm testler geçiyor mu diye kontrol et ✅  
   ```shell
   php artisan test
   ```

## Gizlilik

Bizimle olan işe alım sürecinde sana özel olarak verdiğimiz bu görev, Tarfin A.Ş.'nin mülkiyetindedir ve yalnızca işe alım sürecimiz kapsamında değerlendirme amacıyla sana sunulmuştur. Bu görevin içeriği, koşulları ve ilettiğimiz tüm ilgili materyaller şirketimizin fikri mülkiyetini temsil etmektedir ve gizlilik taahhüdümüz altındadır.

Bu bağlamda, senden aşağıdaki hususlara uyma konusunda anlayış ve iş birliği beklemekteyiz:

**Görev Gizliliği**: Göreve ilişkin tüm materyalleri, soruları ve bu görev kapsamında ürettiğin çözümleri üçüncü şahıslarla paylaşmaman gerekmektedir. Bu, sosyal medya platformları, bloglar, forumlar veya herhangi bir çevrimiçi ve çevrimdışı ortamı kapsamaktadır.

**Fikri Mülkiyet**: Görevin kendisi ve içeriği üzerindeki fikri mülkiyet hakları Tarfin A.Ş.'ne aittir. Görevin hiçbir parçasını herhangi bir şekilde çoğaltamaz, dağıtamaz veya başka herhangi bir amaçla kullanamazsın.

**Görevin Paylaşımı**: Bu görevin herhangi bir parçasını internette veya herhangi bir ortamda paylaşmak, Tarfin A.Ş'nin haklarını ihlal etmek anlamına gelecektir. Böyle bir durumun tespiti halinde, gerekli yasal işlemlerin başlatılacağını hatırlatırız.

Bu görevi sana emanet ederken, profesyonellik ve etik değerlere olan bağlılığını takdir ediyor ve bu konudaki anlayışın için şimdiden teşekkür ediyoruz.
