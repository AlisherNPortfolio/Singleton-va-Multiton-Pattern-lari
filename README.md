# Singleton va Multiton dizayn pattern-i

### Singleton

Singleton pattern-ining maqsadi bitta klasning faqat bitta obyekti mavjud bo'lishini ta'minlashdir. Bu pattern-dan dasturda database, log kabi dasturda faqat bitta obyekti bo'lishi kerak bo'lgan klaslar uchun foydalaniladi.

**Misol:**

Singleton klasi

```bash
<?php

class Singleton
{
    public static function getInstance()
    {
        static $instance;

        if (null === $instance) {
            $instance = new self();
        }

        return $instance;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}
```

`__contstruct` metodini `private` qilishdan maqsad - yangi obyekt olishni cheklash

`__clone` metodini `private` qilishdan maqsad - obyektning klonini olishni cheklash

`__wakeup` metodini `private` qilishdan maqsad - unserialize qilishni oldini olish

Ishlatilishi:

```bash
$instance = Singleton::getInstance();
```

Shuni ta'kidlash kerakki, singleton pattern-i anti-pattern hisoblanadi. Bunga sabab:

* Singleton global holatda ishlaydi. Bu esa yomon holat hisoblanadi. U boshqa klaslar bilan kuchli bog'lanish hosil qiladi.
* Singleton obyektga emas, klasga yo'naltirilgan hisoblanadi.
* Singleton-da nima qo'shimcha imkoniyatlar mavjudligini bila olmaymiz. Chunki, u logikani yashiradi.
* Bir nechta obyekt olib bo'lmasligi sababli, uni test qilish oson bo'lmaydi

Ko'pchilik hech bo'lmsa "yagona obyekt" tabiatidagi database yoki logging-larda singleton-dan foydalanish mumkinligini ta'kidlasada, boshqalar bu pattern-dan umuman foydalanmaslikni tavsiya qiladi (ayniqsa TDD-chilar).

### Multiton

Nomidan ko'rinib turibdiki, multiton dizayn pattern-i klasdan ko'p sondagi obyektlarni olishga imkon beradi. Singleton ham, multiton ham bir xil narsa hisoblanadi, farqi multiton bir nechta obyektni saqlaydi va qaytaradi.

**Misol**:

```bash
class Logger
{
    private static $instances = [];

    public static function getInstance($key)
    {
        if (!array_key_exists($key, self::$instances)) {
            self::$instances[$key] = new self();
        }

        return self::$instances[$key];
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}
```

Ishlatilishi:

```bash
$logInstance = Logger::getInstance('file');
$emailInstance = Logger::getInstance('email');
```
