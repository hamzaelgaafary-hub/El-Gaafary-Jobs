<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string|null $website
 * @property string|null $description
 * @property string $logo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Job> $job
 * @property-read int|null $job_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\EmployerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employer permission($permissions, bool $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employer role($roles, ?string $guard = null, bool $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employer whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employer whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employer whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employer whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employer withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employer withoutRole($roles, ?string $guard = null)
 */
	class Employer extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $employer_id
 * @property string $title
 * @property string $salary
 * @property string $location
 * @property string $url
 * @property string $type
 * @property int $featured
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Employer|null $Employer
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $Tags
 * @property-read int|null $tags_count
 * @method static \Database\Factories\JobFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereEmployerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereUrl($value)
 */
	class Job extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Job> $jobs
 * @property-read int|null $jobs_count
 * @method static \Database\Factories\TagFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereUpdatedAt($value)
 */
	class Tag extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \App\Enums\UserStatusEnum $status
 * @property-read \App\Models\Employer|null $Employer
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, bool $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, ?string $guard = null, bool $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, ?string $guard = null)
 */
	class User extends \Eloquent implements \Filament\Models\Contracts\FilamentUser {}
}

