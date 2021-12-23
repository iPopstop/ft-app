<?php

namespace Database\Seeders;

use App\Models\BalanceHistory;
use App\Models\Comment;
use App\Models\Company;
use App\Models\Coupon;
use App\Models\Employee;
use App\Models\Locale;
use App\Models\Tip;
use App\Models\User;
use Illuminate\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('Загрузка данных');

        $locale = Locale::create([
            'name' => 'Русский',
            'locale' => 'ru'
        ]);

        $user = User::create([
            'first_name' => 'Вячеслав',
            'middle_name' => 'Васильевич',
            'last_name' => 'Кутов',
            'email' => 'kutovvjacheslav3@gmail.com',
            'email_verified_at' => now(),
            'mobile_number' => '89684808151',
            'locale_id' => $locale->id,
            'age' => 19
        ]);

        BalanceHistory::create([
            'type' => 1,
            'sum' => 100,
            'user_id' => $user->id
        ]);

        BalanceHistory::create([
            'type' => 1,
            'sum' => 150,
            'user_id' => $user->id
        ]);
        
        BalanceHistory::create([
            'type' => 2,
            'sum' => 150,
            'user_id' => $user->id
        ]);

        $company = Company::create([
            'name' => 'Кофейня "У Насти"',
            'address' => 'Москва, ул. Пушкина, д. 38',
            'enabled' => 1,
            'email' => 'vkutov@popstop.space'
        ]);

        $company_second = Company::create([
            'name' => 'Кофейня "У Кости"',
            'address' => 'Москва, ул. Пушкина, д. 31',
            'enabled' => 1,
            'email' => 'kostya@popstop.space'
        ]);

        $employee_first = Employee::create([
            'first_name' => 'Анастасия',
            'middle_name' => 'Евгеньевна',
            'last_name' => 'Антонова',
            'company_id' => $company->id,
        ]);

        $employee_second = Employee::create([
            'first_name' => 'Константин',
            'middle_name' => 'Витальевич',
            'last_name' => 'Булавицкий',
            'company_id' => $company->id,
        ]);

        $employee_third = Employee::create([
            'first_name' => '1Константин',
            'middle_name' => '1Витальевич',
            'last_name' => '1Булавицкий',
            'company_id' => $company_second->id
        ]);

        Tip::create([
            'user_id' => $user->id,
            'employee_id' => $employee_first->id,
            'sum_tips' => 500,
            'sum_commission' => 10,
            'commission_payed' => 1
        ]);

        Tip::create([
            'user_id' => $user->id,
            'employee_id' => $employee_first->id,
            'sum_tips' => 100,
            'sum_commission' => 10,
            'commission_payed' => 1
        ]);

        $comment = Comment::create([
            'user_id' => $user->id,
            'message' => 'Всё круто!',
            'employee_id' => $employee_first->id,
            'rate' => 5
        ]);

        $comment_second = Comment::create([
            'user_id' => $user->id,
            'message' => 'Всё ужасно, ничего не понравилось!',
            'employee_id' => $employee_third->id,
            'rate' => 1
        ]);

        $coupon = Coupon::create([
            'company_id' => $company->id,
            'type' => 1,
            'sale' => 100,
            'price_total' => 100,
            'price_company' => 20,
            'description' => 'Вы получаете скидку на приобретение мучных изделий'
        ]);
    }
}
