<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style>

    .dashboard-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        border: 1px solid #f1f5f9;
    }

    .dashboard-card-header {
        padding: 18px 20px;
        border-bottom: 1px solid #f1f5f9;
    }

    .dashboard-card-body {
        padding: 20px;
    }

    .kpi-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        border: 1px solid #f1f5f9;
        transition: all 0.2s ease;
    }

    .kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    .kpi-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 9px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 600;
    }

    .dashboard-table th {
        font-size: 12px;
        color: #64748b;
        font-weight: 600;
        padding: 10px 12px;
        background: #f8fafc;
    }

    .dashboard-table td {
        font-size: 13px;
        padding: 11px 12px;
        border-bottom: 1px solid #f1f5f9;
    }

    .chart-container {
        position: relative;
        height: 300px;
    }

    .small-chart-container {
        position: relative;
        height: 250px;
    }

</style>

<div class="min-h-screen bg-gray-50 relative hr-dashboard">

    <div class="absolute inset-0
                bg-[url('<?= base_url("public/images/car1.png") ?>')]
                bg-center bg-no-repeat bg-contain
                opacity-5 pointer-events-none">
    </div>

    <div class="relative z-10 p-6">

        <div class="bg-white rounded-2xl shadow-md mb-6 overflow-hidden">

            <div class="px-6 py-5">

                <div class="flex flex-col lg:flex-row
                            lg:items-center
                            lg:justify-between gap-5">

                    <div>

                        <p class="text-sm text-gray-500">
                            HR Management
                        </p>

                        <h1 class="text-2xl font-bold text-gray-800">
                            HR Dashboard
                        </h1>

                        <p class="text-sm text-gray-500 mt-1">
                            Employee, attendance, leave, payroll and HR overview
                        </p>

                    </div>

                    <div class="flex flex-wrap gap-3">

                        <div class="bg-gray-50
                                    border border-gray-200
                                    rounded-xl
                                    px-4
                                    py-3">

                            <p class="text-xs
                                      text-gray-500
                                      uppercase
                                      font-semibold">

                                Filter Branch

                            </p>

                            <select
                                id="branchFilter"
                                class="mt-1
                                       text-sm
                                       font-semibold
                                       text-gray-800
                                       bg-transparent
                                       border-0
                                       focus:ring-0
                                       focus:outline-none
                                       cursor-pointer"
                            >

                                <option value="">
                                    All Branches
                                </option>

                                <?php if (!empty($branches)): ?>

                                    <?php foreach ($branches as $branch): ?>

                                        <option
                                            value="<?= (int)$branch->branch_id; ?>"
                                            <?= (
                                                isset($selected_branch_id) &&
                                                (string)$selected_branch_id ===
                                                (string)$branch->branch_id
                                            )
                                                ? 'selected'
                                                : ''; ?>
                                        >

                                            <?= html_escape(
                                                $branch->branch_name
                                            ); ?>

                                        </option>

                                    <?php endforeach; ?>

                                <?php endif; ?>

                            </select>

                        </div>

                        <div class="bg-gray-50
                                    border border-gray-200
                                    rounded-xl
                                    px-4
                                    py-3">

                            <p class="text-xs
                                      text-gray-500
                                      uppercase
                                      font-semibold">

                                From Date

                            </p>

                            <input
                                type="date"
                                id="fromDate"
                                value="<?= html_escape(
                                    $selected_from_date ?? ''
                                ); ?>"
                                class="mt-1
                                       text-sm
                                       font-semibold
                                       text-gray-800
                                       bg-transparent
                                       border-0
                                       focus:ring-0
                                       focus:outline-none"
                            >

                        </div>

                        <div class="bg-gray-50
                                    border border-gray-200
                                    rounded-xl
                                    px-4
                                    py-3">

                            <p class="text-xs
                                      text-gray-500
                                      uppercase
                                      font-semibold">

                                To Date

                            </p>

                            <input
                                type="date"
                                id="toDate"
                                value="<?= html_escape(
                                    $selected_to_date ?? ''
                                ); ?>"
                                class="mt-1
                                       text-sm
                                       font-semibold
                                       text-gray-800
                                       bg-transparent
                                       border-0
                                       focus:ring-0
                                       focus:outline-none"
                            >

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="grid grid-cols-1
                    sm:grid-cols-2
                    lg:grid-cols-4
                    gap-4 mb-6">

            <div class="kpi-card">

                <div class="flex items-center justify-between">

                    <div>

                        <div class="text-sm text-gray-500">
                            Total Employees
                        </div>

                        <div class="text-2xl font-bold text-gray-800 mt-1">

                            <?= number_format(
                                (int)$employee_summary['total_employees']
                            ); ?>

                        </div>

                    </div>

                    <div class="kpi-icon bg-blue-100 text-blue-600">

                        <i class="fa fa-users"></i>

                    </div>

                </div>

            </div>

            <div class="kpi-card">

                <div class="flex items-center justify-between">

                    <div>

                        <div class="text-sm text-gray-500">
                            Active Employees
                        </div>

                        <div class="text-2xl font-bold text-green-600 mt-1">

                            <?= number_format(
                                (int)$employee_summary['active_employees']
                            ); ?>

                        </div>

                    </div>

                    <div class="kpi-icon bg-green-100 text-green-600">

                        <i class="fa fa-user-check"></i>

                    </div>

                </div>

            </div>

            <div class="kpi-card">

                <div class="flex items-center justify-between">

                    <div>

                        <div class="text-sm text-gray-500">
                            New Joinings
                        </div>

                        <div class="text-2xl font-bold text-indigo-600 mt-1">

                            <?= number_format(
                                (int)$employee_summary['new_joinings']
                            ); ?>

                        </div>

                    </div>

                    <div class="kpi-icon bg-indigo-100 text-indigo-600">

                        <i class="fa fa-user-plus"></i>

                    </div>

                </div>

            </div>

            <div class="kpi-card">

                <div class="flex items-center justify-between">

                    <div>

                        <div class="text-sm text-gray-500">
                            Resignations
                        </div>

                        <div class="text-2xl font-bold text-red-600 mt-1">

                            <?= number_format(
                                (int)$employee_summary['resignations']
                            ); ?>

                        </div>

                    </div>

                    <div class="kpi-icon bg-red-100 text-red-600">

                        <i class="fa fa-user-times"></i>

                    </div>

                </div>

            </div>

        </div>

    <div class="grid grid-cols-1
                sm:grid-cols-2
                lg:grid-cols-2
                gap-4 mb-6">

        <div class="kpi-card">

            <div class="flex items-center justify-between">

                <div>

                    <div class="text-sm text-gray-500">
                        Leave Applications
                    </div>

                    <div class="text-2xl font-bold text-gray-800 mt-2">

                        <?= number_format(
                            (int)$leave_summary['leave_applications']
                        ); ?>

                    </div>

                </div>

                <div class="kpi-icon bg-orange-100 text-orange-600">

                    <i class="fa fa-calendar"></i>

                </div>

            </div>

        </div>

        <div class="kpi-card">

            <div class="flex items-center justify-between">

                <div>

                    <div class="text-sm text-gray-500">

                        Employees on Leave
                        <span class="text-xs text-gray-400">
                            (Today)
                        </span>

                    </div>

                    <div class="text-2xl font-bold text-purple-600 mt-2">

                        <?= number_format(
                            (int)$leave_summary['employees_on_leave']
                        ); ?>

                    </div>

                </div>

                <div class="kpi-icon bg-purple-100 text-purple-600">

                    <i class="fa fa-calendar"></i>

                </div>

            </div>

        </div>

    </div>

        <div class="grid grid-cols-1
                    sm:grid-cols-2
                    lg:grid-cols-4
                    gap-4 mb-6">

            <div class="kpi-card">

                <div class="text-sm text-gray-500">
                    Attendance Records
                </div>

                <div class="text-2xl font-bold text-gray-800 mt-2">

                    <?= number_format(
                        (int)$attendance_summary['total_records']
                    ); ?>

                </div>

            </div>

            <div class="kpi-card">

                <div class="text-sm text-gray-500">
                    Present
                </div>

                <div class="text-2xl font-bold text-green-600 mt-2">

                    <?= number_format(
                        (int)$attendance_summary['present_count']
                    ); ?>

                </div>

            </div>

            <div class="kpi-card">

                <div class="text-sm text-gray-500">
                    Absent
                </div>

                <div class="text-2xl font-bold text-red-600 mt-2">

                    <?= number_format(
                        (int)$attendance_summary['absent_count']
                    ); ?>

                </div>

            </div>

            <div class="kpi-card">

                <div class="text-sm text-gray-500">
                    Attendance Percentage
                </div>

                <div class="text-2xl font-bold text-blue-600 mt-2">

                    <?= number_format(
                        (float)$attendance_summary['attendance_percentage'],
                        2
                    ); ?>%

                </div>

            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

            <div class="dashboard-card">

                <div class="dashboard-card-header">

                    <h2 class="font-bold text-gray-800">
                        Employee Movement
                    </h2>

                    <div class="text-xs text-gray-500 mt-1">
                        Joinings vs resignations
                    </div>

                </div>

                <div class="dashboard-card-body">

                    <div class="chart-container">

                        <canvas id="employeeMovementChart"></canvas>

                    </div>

                </div>

            </div>

            <div class="dashboard-card">

                <div class="dashboard-card-header">

                    <h2 class="font-bold text-gray-800">
                        Employees by Department
                    </h2>

                </div>

                <div class="dashboard-card-body">

                    <div class="small-chart-container">

                        <canvas id="departmentChart"></canvas>

                    </div>

                </div>

            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

            <div class="dashboard-card">

                <div class="dashboard-card-header">

                    <h2 class="font-bold text-gray-800">
                        Employees by Branch
                    </h2>

                </div>

                <div class="dashboard-card-body">

                    <div class="small-chart-container">

                        <canvas id="branchChart"></canvas>

                    </div>

                </div>

            </div>

            <div class="dashboard-card">

                <div class="dashboard-card-header">

                    <h2 class="font-bold text-gray-800">
                        Attendance Trend
                    </h2>

                    <div class="text-xs text-gray-500 mt-1">
                        Present and absent attendance records
                    </div>

                </div>

                <div class="dashboard-card-body">

                    <div class="small-chart-container">

                        <canvas id="attendanceTrendChart"></canvas>

                    </div>

                </div>

            </div>

        </div>

        <div class="dashboard-card mb-6">

            <div class="dashboard-card-header">

                <h2 class="font-bold text-gray-800">
                    Salary Structure Summary
                </h2>

            </div>

            <div class="dashboard-card-body">

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <div class="bg-gray-50 rounded-xl p-4">

                        <div class="text-sm text-gray-500">
                            Basic Salary
                        </div>

                        <div class="text-xl font-bold text-gray-800 mt-1">

                            AED
                            <?= number_format(
                                (float)$salary_summary['basic_salary'],
                                2
                            ); ?>

                        </div>

                    </div>

                    <div class="bg-green-50 rounded-xl p-4">

                        <div class="text-sm text-gray-500">
                            Allowances
                        </div>

                        <div class="text-xl font-bold text-green-700 mt-1">

                            AED
                            <?= number_format(
                                (float)$salary_summary['total_allowances'],
                                2
                            ); ?>

                        </div>

                    </div>

                    <div class="bg-red-50 rounded-xl p-4">

                        <div class="text-sm text-gray-500">
                            Deductions
                        </div>

                        <div class="text-xl font-bold text-red-700 mt-1">

                            AED
                            <?= number_format(
                                (float)$salary_summary['total_deductions'],
                                2
                            ); ?>

                        </div>

                    </div>

                    <div class="bg-blue-50 rounded-xl p-4">

                        <div class="text-sm text-gray-500">
                            Gross Salary
                        </div>

                        <div class="text-xl font-bold text-blue-700 mt-1">

                            AED
                            <?= number_format(
                                (float)$salary_summary['gross_salary'],
                                2
                            ); ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

            <div class="dashboard-card">

                <div class="dashboard-card-header">

                    <h2 class="font-bold text-gray-800">
                        Passport Status
                    </h2>

                </div>

                <div class="dashboard-card-body">

                    <div class="grid grid-cols-2 gap-4">

                        <div class="bg-blue-50 rounded-xl p-4 md:col-span-2">

                            <div class="text-sm text-gray-500">
                                Passport Holders
                            </div>

                            <div class="text-2xl font-bold text-blue-700 mt-1">

                                <?= number_format(
                                    (int)$passport_summary['with_passport']
                                ); ?>

                            </div>

                        </div>

                        <div class="bg-red-50 rounded-xl p-4">

                            <div class="text-sm text-gray-500">
                                Expired
                            </div>

                            <div class="text-2xl font-bold text-red-700 mt-1">

                                <?= number_format(
                                    (int)$passport_summary['expired']
                                ); ?>

                            </div>

                        </div>

                        <div class="bg-yellow-50 rounded-xl p-4">

                            <div class="text-sm text-gray-500">
                                Expiring Soon
                            </div>

                            <div class="text-2xl font-bold text-yellow-700 mt-1">

                                <?= number_format(
                                    (int)$passport_summary['expiring_soon']
                                ); ?>

                            </div>

                        </div>

                        <div class="bg-purple-50 rounded-xl p-4">

                            <div class="text-sm text-gray-500">
                                Held by Company
                            </div>

                            <div class="text-2xl font-bold text-purple-700 mt-1">

                                <?= number_format(
                                    (int)$passport_summary['held_by_company']
                                ); ?>

                            </div>

                        </div>

                        <div class="bg-green-50 rounded-xl p-4">

                            <div class="text-sm text-gray-500">
                                Held by Employee
                            </div>

                            <div class="text-2xl font-bold text-green-700 mt-1">

                                <?= number_format(
                                    (int)$passport_summary['held_by_employee']
                                ); ?>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="dashboard-card">

                <div class="dashboard-card-header">

                    <div class="flex items-center justify-between">

                        <div>

                            <h2 class="font-bold text-gray-800">
                                Passport Expiry Alerts
                            </h2>

                            <div class="text-xs text-gray-500 mt-1">
                                Expired and upcoming passport expiry details
                            </div>

                        </div>

                        <span class="status-badge bg-orange-100 text-orange-700">

                            <?= !empty($passport_expiry_alerts)
                                ? count($passport_expiry_alerts)
                                : 0; ?>

                        </span>

                    </div>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full dashboard-table">

                        <thead>

                            <tr>

                                <th class="text-left">
                                    Employee
                                </th>

                                <th class="text-left">
                                    Code
                                </th>

                                <th class="text-left">
                                    Passport Number
                                </th>

                                <th class="text-left">
                                    Expiry Date
                                </th>

                                <th class="text-center">
                                    Status
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if (!empty($passport_expiry_alerts)): ?>

                                <?php foreach (
                                    $passport_expiry_alerts
                                    as $passport
                                ): ?>

                                    <tr>

                                        <td class="font-semibold text-gray-700">

                                            <?= !empty($passport->employee_name)
                                                ? html_escape(
                                                    $passport->employee_name
                                                )
                                                : '-'; ?>

                                        </td>

                                        <td class="text-gray-600">

                                            <?= !empty($passport->employee_code)
                                                ? html_escape(
                                                    $passport->employee_code
                                                )
                                                : '-'; ?>

                                        </td>

                                        <td>

                                            <?= !empty(
                                                $passport->document_number
                                            )
                                                ? html_escape(
                                                    $passport->document_number
                                                )
                                                : '-'; ?>

                                        </td>

                                        <td>

                                            <?php if (
                                                !empty(
                                                    $passport->expiry_date
                                                )
                                            ): ?>

                                                <span class="font-medium text-gray-800">

                                                    <?= date(
                                                        'd M Y',
                                                        strtotime(
                                                            $passport->expiry_date
                                                        )
                                                    ); ?>

                                                </span>

                                            <?php else: ?>

                                                -

                                            <?php endif; ?>

                                        </td>

                                        <td class="text-center">

                                            <?php

                                            $expiry_status = !empty(
                                                $passport->expiry_status
                                            )
                                                ? strtolower(
                                                    trim(
                                                        $passport->expiry_status
                                                    )
                                                )
                                                : '';

                                            ?>

                                            <?php if (
                                                $expiry_status === 'expired'
                                            ): ?>

                                                <span class="status-badge bg-red-100 text-red-700">
                                                    Expired
                                                </span>

                                            <?php elseif (
                                                $expiry_status === 'expiring soon'
                                                || $expiry_status === 'expiring_soon'
                                            ): ?>

                                                <span class="status-badge bg-orange-100 text-orange-700">
                                                    Expiring Soon
                                                </span>

                                            <?php else: ?>

                                                <span class="status-badge bg-green-100 text-green-700">
                                                    Valid
                                                </span>

                                            <?php endif; ?>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>

                                    <td
                                        colspan="5"
                                        class="text-center text-gray-500 py-8"
                                    >

                                        No passport expiry alerts found.

                                    </td>

                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

            <div class="dashboard-card">

                <div class="dashboard-card-header">

                    <div class="flex items-center justify-between">

                        <div>

                            <h2 class="font-bold text-gray-800">
                                Upcoming Holidays
                            </h2>

                            <div class="text-xs text-gray-500 mt-1">
                                Upcoming company holidays
                            </div>

                        </div>

                        <span class="status-badge bg-blue-100 text-blue-700">

                            <?= !empty($upcoming_holidays)
                                ? count($upcoming_holidays)
                                : 0; ?>

                        </span>

                    </div>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full dashboard-table">

                        <thead>

                            <tr>

                                <th class="text-left">
                                    Holiday
                                </th>

                                <th class="text-left">
                                    Date
                                </th>

                                <th class="text-left">
                                    Description
                                </th>

                                <th class="text-left">
                                    Holiday Code
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if (!empty($upcoming_holidays)): ?>

                                <?php foreach (
                                    $upcoming_holidays
                                    as $holiday
                                ): ?>

                                    <tr>

                                        <td class="font-semibold text-gray-700">

                                            <?= !empty($holiday->holiday_name)
                                                ? html_escape(
                                                    $holiday->holiday_name
                                                )
                                                : '-'; ?>

                                        </td>

                                        <td>

                                            <?php if (
                                                !empty($holiday->h_date)
                                            ): ?>

                                                <span class="font-medium text-gray-800">

                                                    <?= date(
                                                        'd M Y',
                                                        strtotime(
                                                            $holiday->h_date
                                                        )
                                                    ); ?>

                                                </span>

                                            <?php else: ?>

                                                -

                                            <?php endif; ?>

                                        </td>

                                        <td class="text-gray-600">

                                            <?= !empty(
                                                $holiday->holiday_des
                                            )
                                                ? html_escape(
                                                    $holiday->holiday_des
                                                )
                                                : '-'; ?>

                                        </td>

                                        <td>

                                            <?php if (
                                                !empty(
                                                    $holiday->holiday_code
                                                )
                                            ): ?>

                                                <span class="status-badge bg-blue-100 text-blue-700">

                                                    <?= html_escape(
                                                        $holiday->holiday_code
                                                    ); ?>

                                                </span>

                                            <?php else: ?>

                                                -

                                            <?php endif; ?>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>

                                    <td
                                        colspan="4"
                                        class="text-center text-gray-500 py-8"
                                    >

                                        No upcoming holidays.

                                    </td>

                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="dashboard-card">

                <div class="dashboard-card-header">

                    <div class="flex items-center justify-between">

                        <div>

                            <h2 class="font-bold text-gray-800">
                                Recent Resignations
                            </h2>

                            <div class="text-xs text-gray-500 mt-1">
                                Latest employee resignation records
                            </div>

                        </div>

                        <span class="status-badge bg-red-100 text-red-700">

                            <?= !empty($recent_resignations)
                                ? count($recent_resignations)
                                : 0; ?>

                        </span>

                    </div>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full dashboard-table">

                        <thead>

                            <tr>

                                <th class="text-left">
                                    Employee
                                </th>

                                <th class="text-left">
                                    Code
                                </th>

                                <th class="text-left">
                                    Resignation Date
                                </th>

                                <th class="text-left">
                                    Last Working Date
                                </th>

                                <th class="text-center">
                                    Notice Days
                                </th>

                                <th class="text-center">
                                    Status
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if (!empty($recent_resignations)): ?>

                                <?php foreach (
                                    $recent_resignations
                                    as $resignation
                                ): ?>

                                    <tr>

                                        <td class="font-semibold text-gray-700">

                                            <?= html_escape(
                                                !empty(
                                                    $resignation->employee_name
                                                )
                                                    ? $resignation->employee_name
                                                    : '-'
                                            ); ?>

                                        </td>

                                        <td class="text-gray-600">

                                            <?= html_escape(
                                                !empty(
                                                    $resignation->resign_code
                                                )
                                                    ? $resignation->resign_code
                                                    : '-'
                                            ); ?>

                                        </td>

                                        <td>

                                            <?= !empty(
                                                $resignation->resignation_date
                                            )
                                                ? date(
                                                    'd M Y',
                                                    strtotime(
                                                        $resignation->resignation_date
                                                    )
                                                )
                                                : '-'; ?>

                                        </td>

                                        <td>

                                            <?= !empty(
                                                $resignation->last_working_date
                                            )
                                                ? date(
                                                    'd M Y',
                                                    strtotime(
                                                        $resignation->last_working_date
                                                    )
                                                )
                                                : '-'; ?>

                                        </td>

                                        <td class="text-center">

                                            <?= !empty(
                                                $resignation->notice_days
                                            )
                                                ? (int)$resignation->notice_days
                                                : '-'; ?>

                                        </td>

                                        <td class="text-center">

                                            <span class="status-badge bg-red-100 text-red-700">
                                                Resigned
                                            </span>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>

                                    <td
                                        colspan="6"
                                        class="text-center text-gray-500 py-8"
                                    >

                                        No recent resignations found.

                                    </td>

                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <div class="dashboard-card mb-6">

            <div class="dashboard-card-header">

                <h2 class="font-bold text-gray-800">
                    HR Reminders & Alerts
                </h2>

                <div class="text-xs text-gray-500 mt-1">
                    Items requiring HR attention
                </div>

            </div>

            <div class="dashboard-card-body">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <div class="flex items-center justify-between
                                p-4
                                bg-red-50
                                rounded-xl">

                        <div>

                            <div class="font-semibold text-red-800">
                                Expired Passports
                            </div>

                            <div class="text-sm text-red-600 mt-1">
                                Passport expiry date has passed
                            </div>

                        </div>

                        <div class="text-2xl font-bold text-red-700">

                            <?= (int)$hr_reminders[
                                'passport_expired'
                            ]; ?>

                        </div>

                    </div>

                    <div class="flex items-center justify-between
                                p-4
                                bg-yellow-50
                                rounded-xl">

                        <div>

                            <div class="font-semibold text-yellow-800">
                                Passports Expiring
                            </div>

                            <div class="text-sm text-yellow-600 mt-1">
                                Expiring within 6 months
                            </div>

                        </div>

                        <div class="text-2xl font-bold text-yellow-700">

                            <?= (int)$hr_reminders[
                                'passport_expiring'
                            ]; ?>

                        </div>

                    </div>

                    <div class="flex items-center justify-between
                                p-4
                                bg-blue-50
                                rounded-xl">

                        <div>

                            <div class="font-semibold text-blue-800">
                                Pending Exits
                            </div>

                            <div class="text-sm text-blue-600 mt-1">
                                Employees leaving soon
                            </div>

                        </div>

                        <div class="text-2xl font-bold text-blue-700">

                            <?= (int)$hr_reminders[
                                'pending_exits'
                            ]; ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const branchFilter =
            document.getElementById(
                'branchFilter'
            );

        const fromDate =
            document.getElementById(
                'fromDate'
            );

        const toDate =
            document.getElementById(
                'toDate'
            );

        function applyDashboardFilters()
        {

            const url =
                new URL(
                    window.location.href
                );

            if (
                branchFilter &&
                branchFilter.value
            ) {

                url.searchParams.set(
                    'branch_id',
                    branchFilter.value
                );

            } else {

                url.searchParams.delete(
                    'branch_id'
                );

            }

            if (
                fromDate &&
                fromDate.value
            ) {

                url.searchParams.set(
                    'from_date',
                    fromDate.value
                );

            } else {

                url.searchParams.delete(
                    'from_date'
                );

            }

            if (
                toDate &&
                toDate.value
            ) {

                url.searchParams.set(
                    'to_date',
                    toDate.value
                );

            } else {

                url.searchParams.delete(
                    'to_date'
                );

            }

            window.location.href =
                url.toString();

        }

        if (branchFilter) {

            branchFilter.addEventListener(
                'change',
                function () {

                    applyDashboardFilters();

                }
            );

        }

        if (fromDate) {

            fromDate.addEventListener(
                'change',
                function () {

                    if (
                        toDate &&
                        toDate.value &&
                        this.value > toDate.value
                    ) {

                        alert(
                            'From Date cannot be greater than To Date.'
                        );

                        this.value =
                            '<?= html_escape(
                                $selected_from_date ?? ''
                            ); ?>';

                        return;

                    }

                    applyDashboardFilters();

                }
            );

        }

        if (toDate) {

            toDate.addEventListener(
                'change',
                function () {

                    if (
                        fromDate &&
                        fromDate.value &&
                        this.value < fromDate.value
                    ) {

                        alert(
                            'To Date cannot be earlier than From Date.'
                        );

                        this.value =
                            '<?= html_escape(
                                $selected_to_date ?? ''
                            ); ?>';

                        return;

                    }

                    applyDashboardFilters();

                }
            );

        }

        const employeeMovementCanvas =
            document.getElementById(
                'employeeMovementChart'
            );

        if (employeeMovementCanvas) {

            new Chart(
                employeeMovementCanvas,
                {

                    type: 'line',

                    data: {

                        labels:
                            <?= json_encode(
                                isset(
                                    $employee_movement_chart['labels']
                                )
                                    ? $employee_movement_chart['labels']
                                    : array()
                            ); ?>,

                        datasets: [

                            {

                                label: 'Joinings',

                                data:
                                    <?= json_encode(
                                        isset(
                                            $employee_movement_chart['joinings']
                                        )
                                            ? $employee_movement_chart['joinings']
                                            : array()
                                    ); ?>,

                                borderWidth: 2,

                                tension: 0.3,

                                fill: false

                            },

                            {

                                label: 'Resignations',

                                data:
                                    <?= json_encode(
                                        isset(
                                            $employee_movement_chart['resignations']
                                        )
                                            ? $employee_movement_chart['resignations']
                                            : array()
                                    ); ?>,

                                borderWidth: 2,

                                tension: 0.3,

                                fill: false

                            }

                        ]

                    },

                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        plugins: {

                            legend: {

                                position: 'bottom'

                            }

                        },

                        scales: {

                            y: {

                                beginAtZero: true

                            }

                        }

                    }

                }
            );

        }

        const departmentCanvas =
            document.getElementById(
                'departmentChart'
            );

        if (departmentCanvas) {

            new Chart(
                departmentCanvas,
                {

                    type: 'doughnut',

                    data: {

                        labels:
                            <?= json_encode(
                                isset(
                                    $department_chart['labels']
                                )
                                    ? $department_chart['labels']
                                    : array()
                            ); ?>,

                        datasets: [

                            {

                                data:
                                    <?= json_encode(
                                        isset(
                                            $department_chart['values']
                                        )
                                            ? $department_chart['values']
                                            : array()
                                    ); ?>,

                                borderWidth: 1

                            }

                        ]

                    },

                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        plugins: {

                            legend: {

                                position: 'bottom'

                            }

                        }

                    }

                }
            );

        }

        const branchCanvas =
            document.getElementById(
                'branchChart'
            );

        if (branchCanvas) {

            new Chart(
                branchCanvas,
                {

                    type: 'bar',

                    data: {

                        labels:
                            <?= json_encode(
                                isset(
                                    $branch_chart['labels']
                                )
                                    ? $branch_chart['labels']
                                    : array()
                            ); ?>,

                        datasets: [

                            {

                                label: 'Employees',

                                data:
                                    <?= json_encode(
                                        isset(
                                            $branch_chart['values']
                                        )
                                            ? $branch_chart['values']
                                            : array()
                                    ); ?>,

                                borderWidth: 1

                            }

                        ]

                    },

                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        plugins: {

                            legend: {

                                display: false

                            }

                        },

                        scales: {

                            y: {

                                beginAtZero: true

                            }

                        }

                    }

                }
            );

        }

        const leaveTypeCanvas =
            document.getElementById(
                'leaveTypeChart'
            );

        if (leaveTypeCanvas) {

            new Chart(
                leaveTypeCanvas,
                {

                    type: 'pie',

                    data: {

                        labels:
                            <?= json_encode(
                                isset(
                                    $leave_type_chart['labels']
                                )
                                    ? $leave_type_chart['labels']
                                    : array()
                            ); ?>,

                        datasets: [

                            {

                                data:
                                    <?= json_encode(
                                        isset(
                                            $leave_type_chart['values']
                                        )
                                            ? $leave_type_chart['values']
                                            : array()
                                    ); ?>,

                                borderWidth: 1

                            }

                        ]

                    },

                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        plugins: {

                            legend: {

                                position: 'bottom'

                            }

                        }

                    }

                }
            );

        }

        const attendanceTrendCanvas =
            document.getElementById(
                'attendanceTrendChart'
            );

        if (attendanceTrendCanvas) {

            new Chart(
                attendanceTrendCanvas,
                {

                    type: 'line',

                    data: {

                        labels:
                            <?= json_encode(
                                isset(
                                    $attendance_trend['labels']
                                )
                                    ? $attendance_trend['labels']
                                    : array()
                            ); ?>,

                        datasets: [

                            {

                                label: 'Present',

                                data:
                                    <?= json_encode(
                                        isset(
                                            $attendance_trend['present']
                                        )
                                            ? $attendance_trend['present']
                                            : array()
                                    ); ?>,

                                borderWidth: 2,

                                tension: 0.3,

                                fill: false

                            },

                            {

                                label: 'Absent',

                                data:
                                    <?= json_encode(
                                        isset(
                                            $attendance_trend['absent']
                                        )
                                            ? $attendance_trend['absent']
                                            : array()
                                    ); ?>,

                                borderWidth: 2,

                                tension: 0.3,

                                fill: false

                            }

                        ]

                    },

                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        plugins: {

                            legend: {

                                position: 'bottom'

                            }

                        },

                        scales: {

                            y: {

                                beginAtZero: true

                            }

                        }

                    }

                }
            );

        }

    }

);

</script>
