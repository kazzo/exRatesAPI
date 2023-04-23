# Wstęp
Użyłem frameworka laravel 10.7 i PHP 8.2

# Endpoints

## Logowanie
URL: /api/login

Metoda POST

Parametry:
- email (wymagany)
- password (wymagany)

Zwraca (w przypadku powodzenia):
- status: true
- token

## Wylogowanie
URL: /api/logout

Metoda POST

Nagłówki:
- Authorization: Bearer *TOKEN*

Zwraca (w przypadku powodzenia):
- status: true 

## Dodanie kursu waluty
URL: /api/exchangerate

Metoda POST

Nagłówki:
- Authorization: Bearer *TOKEN*

Parametry:
- date (wymagany)
- currency (wymagany) (format YYYY-mm-dd)
- amount (wymagany) (zapisywany jest z dokładnością 4 cyfr po przecinku - tak publikowane są kursy)
- quantity(opcjonalny) (dla niektórych walut są podawane kursy dla ilości innej niż 1)
*Tylko użytkownicy z ustawionym role 'ADDER' lub 'ADMIN' w bazie danych mogą dodawać kursy*

Zwraca (w przypadku powodzenia):
- status: true 

## Lista kursów walut z danego dnia
URL: /api/exchangerate/{data} *(data w formacie YYYY-mm-dd)*

Metoda GET

Nagłówki:
- Authorization: Bearer *TOKEN*

Zwraca (w przypadku powodzenia):
- tabelę kursów dla daty równej lub najbliższej mniejszej od podanej (tabele są publikowane tylko w dni robocze)

## Lista kursów walut z danego dnia
URL: /api/exchangerate/{data}/{waluta} *(data w formacie YYYY-mm-dd, waluta - trzyliterowy symbol waluty)*

Metoda GET

Nagłówki:
- Authorization: Bearer *TOKEN*

Zwraca (w przypadku powodzenia):
- tabelę kursów żądanej waluty dla daty równej lub najbliższej mniejszej od podanej (tabele są publikowane tylko w dni robocze)
