<x-layout>
    <x-page-heading>Register</x-page-heading>

    <x-forms.form method="POST" action="/register" enctype="multipart/form-data">
        <x-forms.input label="Name" name="name" />
        <x-forms.input label="Email" name="email" type="email" />
        <x-forms.input label="Password" name="password" type="password" />
        <x-forms.input label="Password Confirmation" name="password_confirmation" type="password" />

        <x-forms.divider />

<<<<<<< HEAD
        <x-forms.input label="Employer Name" name="employer" />
=======
        <x-forms.input label="Employer Name" name="Employer" />
>>>>>>> 328b122 (First commit from New pulled version)
        <x-forms.input label="Employer Logo" name="logo" type="file" />

        <x-forms.button>Create Account</x-forms.button>
        @dd($request->all())
    </x-forms.form>
<<<<<<< HEAD
</x-layout>
=======
</x-layout>
>>>>>>> 328b122 (First commit from New pulled version)
