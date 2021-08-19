<div align="center">

<a href="https://tarfin.com" target="_blank">
    <img src=".github/logo.svg" height="100">
</a>

</div>

<div align="center">

## Card Challenge

</div>

### Setup procedure

1. Fork the repository in your personal GitHub account
2. Checkout a new feature branch from `main`
3. Make your changes in each [commit atomic](https://en.wikipedia.org/wiki/Atomic_commit)
4. Push the code and prepare the Pull Request from feature branch to `main` branch

### Test #01

#### Objective

Create feature tests to test `TarfinCard` and `TarfinCardTransaction` endpoints and their relative policies, validations
and resources.

#### Business Logic

- Each customer can have multiple `TarfinCard`s and each `TarfinCard` can have many `TarfinCardTransaction`s.
- A customer should be able to create, update, read, list, and delete his `TarfinCard`s.
- For each `TarfinCard`, the customer should be able to list, read and create `TarfinCardTransaction`.

#### Tarfin Cards Endpoints:

For each endpoint, there are specific conditions and validations to assert

- **GET** `/api/tarfin-cards`
- **POST** `/api/tarfin-cards`
- **GET** `/api/tarfin-cards/{tarfin_card}`
- **PUT|PATCH** `/api/tarfin-cards/{tarfin_card}`
- **DELETE** `/api/tarfin-cards/{tarfin_card}`

#### Tarfin Card Transactions Endpoints *(OPTIONAL / BONUS POINT)*:

- **GET** `/api/tarfin-cards/{tarfin_card}/tarfin-card-transactions`
- **POST** `/api/tarfin-cards/{tarfin_card}/tarfin-card-transactions`
- **GET** `/api/tarfin-card-transactions/{tarfin-card-transaction}`

#### Challenge

Read through the *TarfinCard* and *TarfinCardTransaction* routes, controllers, requests, resources, and policies.
Understand the logic and write as many tests as possible to validate the endpoints. The `TarfinCardControllerTest`
and `TarfinCardTransactionControllerTest` are already created, you just need to complete them.

#### Tips

- Verify positive and negative scenarios
- Assert response and database values
- Customer can handle only his `TarfinCard`s

**IMPORTANT:** For this challenge you SHOULD ONLY update the feature tests
