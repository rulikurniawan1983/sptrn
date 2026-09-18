<div class="alert alert-success text-dark">
    <div>{{ session('success_register_and_verify') }}</div>
    <div class="my-3">
        Apabila dalam 5 menit kedepan Anda tidak mendapatkan email verifikasi klik
        <strong>Kirim Ulang</strong>
    </div>
    {{ html()->form('POST', route('verification.resend'))->class('mb-1')->attribute('enctype', 'multipart/form-data')->open() }}
    {{ html()->hidden('email', session('verificationEmail')) }}
    <button class="btn btn-success btn-sm">Kirim Ulang</button>
    {{ html()->form()->close() }}
</div>
