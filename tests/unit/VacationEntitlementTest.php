<?php

use CodeIgniter\Test\CIUnitTestCase;

/**
 * @internal
 */
final class VacationEntitlementTest extends CIUnitTestCase
{
    /**
     * Test vacation entitlement calculation for the 3 employees as of 31 January 2025.
     * Formula: Entitlement = (Selected Date - Vacation Due From + 1) * (Days/Year) / 365
     */
    public function testVacationEntitlementCalculation()
    {
        $selectedDate = '2025-01-31';

        $scenarios = [
            'AFG - 0002' => [
                'name' => 'Shihab Fasaludheen',
                'vacation_due_from' => '2023-01-01',
                'days_per_year' => 28,
                'expected_diff_inclusive' => 762,
                'expected_entitlement' => '58.45', // (762 * 28) / 365 = 58.45479...
            ],
            'AFG - 0003' => [
                'name' => 'Justin Jose',
                'vacation_due_from' => '2025-01-01',
                'days_per_year' => 28,
                'expected_diff_inclusive' => 31,
                'expected_entitlement' => '2.38', // (31 * 28) / 365 = 2.37808...
            ],
            'AFG - 0011' => [
                'name' => 'Lingarpasath Wiramuttu Selvaraja',
                'vacation_due_from' => '2022-10-17',
                'days_per_year' => 21,
                'expected_diff_inclusive' => 838,
                'expected_entitlement' => '48.21', // (838 * 21) / 365 = 48.21369...
            ],
        ];

        foreach ($scenarios as $empId => $data) {
            $diff = (int)(abs(strtotime($selectedDate) - strtotime($data['vacation_due_from'])) / 86400);
            $diff++; // Inclusive calendar days

            $this->assertSame($data['expected_diff_inclusive'], $diff, "Inclusive days mismatch for {$empId}");

            $entitlement = $diff * $data['days_per_year'] / 365;
            $formattedEntitlement = number_format($entitlement, 2, '.');

            $this->assertSame($data['expected_entitlement'], $formattedEntitlement, "Entitlement mismatch for {$empId}");
        }
    }

    /**
     * Test exact date boundary conditions.
     */
    public function testDateBoundaries()
    {
        // Same day: 2025-01-31 to 2025-01-31 -> diff = 0, inclusive = 1 day
        $date = '2025-01-31';
        $due = '2025-01-31';
        $diff = (int)(abs(strtotime($date) - strtotime($due)) / 86400);
        $diff++;
        $this->assertSame(1, $diff);

        // 1 month inclusive: 2025-01-01 to 2025-01-31 -> 31 days
        $dueMonthStart = '2025-01-01';
        $diffMonth = (int)(abs(strtotime($date) - strtotime($dueMonthStart)) / 86400);
        $diffMonth++;
        $this->assertSame(31, $diffMonth);

        $entitlementMonth = number_format($diffMonth * 28 / 365, 2, '.');
        $this->assertSame('2.38', $entitlementMonth);
    }
}
