<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        // 头像假数据
        $avatars = [
            'http://www.yutudou.com/uploads/allimg/170809/1-1FP9221236.jpg',
            'http://8.pic.9ht.com/thumb/up/2018-4/201842795016108200_600_566.jpg',
            'http://img3.imgtn.bdimg.com/it/u=1486068326,2690743681&fm=26&gp=0.jpg',
            'http://img.duoziwang.com/2016/10/02/1451111685.jpg',
            'http://img.duoziwang.com/2017/10/1722593612686.jpg',
            'http://www.touxiangdaquan.net/uploads/allimg/c150625/143521454V9320-4b249.jpg',
            'http://img5.imgtn.bdimg.com/it/u=2587803502,3203790569&fm=26&gp=0.jpg',
            'http://b-ssl.duitang.com/uploads/item/201708/29/20170829124617_XyhLs.thumb.1000_0.jpeg'
        ];

        // 生成数据集合
        $users = factory(User::class)
            ->times(10)
            ->make()
            ->each(function ($user, $index)
            use ($faker, $avatars)
            {
                // 从头像数组中随机取出一个并赋值
                $user->avatar = $faker->randomElement($avatars);
            });

        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        User::insert($user_array);

        // 单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = '装逼王我当定了';
        $user->email = '823479033@qq.com';
        $user->avatar = 'http://www.yutudou.com/uploads/allimg/170809/1-1FP9221236.jpg';
        $user->save();


        // 初始化用户角色，将 1 号用户指派为『站长』
        $user->assignRole('Founder');

        // 将 2 号用户指派为『管理员』
        $user = User::find(2);
        $user->assignRole('Maintainer');

    }



}
