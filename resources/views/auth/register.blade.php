<x-layout>
        <x-page-heading>Register</x-page-heading>

        <x-forms.form method="POST" action="/register" enctype="multipart/form-data">
                <x-forms.input label="Name" name="name" />
                <x-forms.input label="Email" name="email" type="email" />
                <x-forms.select label="Type" name="type" t>
                        <option value="Admin" name="Admin" disabled> Admin</option>
                        <option value="Employer" name="Employer"> Employer</option>
                        <option value="JobSeeker" name="JobSeeker" selected> JobSeeker</option>
                </x-forms.select>
                <x-forms.input label="Password" name="password" type="password" />
                <x-forms.input label="Password Confirmation" name="password_confirmation" type="password" />
                <x-forms.button>Create Account</x-forms.button>
        </x-forms.form>
</x-layout>