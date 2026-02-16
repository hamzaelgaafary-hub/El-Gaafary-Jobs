<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Employer;

class UserObserver
{

     

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    
    public function updated(User $user)
    {
        if ($user->isDirty('status') && $user->status === 'employer') {
            
            // 1. تعيين الدور باستخدام Spatie
            $user->assignRole('employer');

            // 2. إنشاء سجل في جدول Employers تلقائياً
            // firstOrCreate تمنع تكرار السجل إذا تحول المستخدم من وإلى employer عدة مرات
            Employer::firstOrCreate(
                ['user_id' => $user->id],
                ['name' => $user->name . ' Company.'] // بيانات افتراضية
            );
        }
    }
    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
