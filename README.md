# Who Guards the Guardians: Writing Tests That Actually Find Bugs

This is the companion repository for the tech talk **"Who Guards the Guardians: Writing Tests That Actually Find Bugs."**

The core premise of the talk is that **Coverage does not equal Correctness**. It is very easy to write tests that achieve 100% line coverage but completely miss catastrophic business logic failures.

This Symfony API project implements 10 specific business scenarios. Each scenario consists of an Entity, a Service, and a set of Tests.

## The Flawed vs. Correct Paradigm

The `src/Service/` and `tests/` directories have been divided into two namespaces: `Flawed` and `Correct`.

### 1. The Flawed Group (Coverage does not equal Correctness)
Located in `src/Service/Flawed/` and `tests/Flawed/`.
Every Service in this group contains an intentional business logic **bug**. However, the `_FLAWED` tests verify the mechanics or happy paths of the code without verifying the business rule itself.
- **Run this test suite to see it pass:** `php bin/phpunit --testsuite Flawed`
- This proves you can achieve green tests and 100% test coverage while failing the actual business requirements.

### 2. The Correct Group (Testing Domain Invariants)
Located in `src/Service/Correct/` and `tests/Correct/`.
These Services contain the **fixes** to the bugs seen in the Flawed group. The `_CORRECT` tests explicitly assert the edge cases, logical boundaries, and constraints of the business rules.
- **Run this test suite to see it pass:** `php bin/phpunit --testsuite Correct`
- This proves that when tests target the boundaries instead of just the lines of code, they accurately reflect the health of the system.

## The 10 Scenarios

1. **The "Happy Path" Illusion**: A promotion applicator that forgets to apply maximum caps.
2. **The Mocking Mirage**: Overdue subscriptions blinded by mocked repositories.
3. **Order of Operations**: A checkout calculator evaluating discounts in sequence instead of sorted order.
4. **The Silent Zero Trap**: `empty(0.0)` invalidating completely valid zero-weight digital carts.
5. **Mutating State Oversight**: A refund processor that issues a refund but forgets to update the database status.
6. **Invalid State Transition**: Shipment status moving backwards out of "delivered" to "in transit" blindly.
7. **The Blind Append**: Mixing dangerous chemicals (Lithium-ion & Lead-acid) in storage bins.
8. **The Floating Point Illusion**: Oil spill detectors truncating float numbers to integers in critical safety checks.
9. **Phantom Pagination**: Exporters missing records because mocked DB finders hide default database limits.
10. **Logic Operator Bypass**: Social media block lists failing due to `||` early-return operators.

## Requirements

- PHP 8.2+
- Composer

## Installation & Running the Code

1. Install dependencies via Composer:
   ```bash
   composer install
   ```
2. Run the PHPUnit test suite:
   ```bash
   php bin/phpunit
   ```

You should see an output containing **10 passes, and exactly 10 failures or errors**, demonstrating that the _FLAWED_ tests pass, but the _CORRECT_ tests catch the bugs and fail.
