<?php

use Illuminate\Database\Seeder;
use App\Message;
class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class,50)->create();
        $user = DB::table('users')->insertGetId([
            'name' => 'axel AMGHAR',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user')
        ]);
        $admin = DB::table('users')->insertGetId([
            'name' => 'dorian Saez',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin')
        ]);

        $conversation = DB::table('conversations')->insertGetId([
            'user1_id' => $user,
            'user2_id' => $admin,
        ]);

        $message = new Message();
        $message->conversation_id = $conversation;
        $message->user_id = $user;
        $message->message = 'salut ça va ';
        $message->save();

        $message = new Message();
        $message->conversation_id = $conversation;
        $message->user_id = $admin;
        $message->message = 'oui et toi ';
        $message->save();

        $message = new Message();
        $message->conversation_id = $conversation;
        $message->user_id =  $user;
        $message->message = ':)';
        $message->save();

    }
}
