<div
    x-data="{
        token: '',
        sitekey: '{{ config('recaptchav3.sitekey') }}',
        init() {
            this.execute();
            // Refresh token every 90 seconds (v3 tokens expire after 2 minutes)
            setInterval(() => this.execute(), 90000);
        },
        execute() {
            if (typeof grecaptcha === 'undefined') {
                setTimeout(() => this.execute(), 500);
                return;
            }
            grecaptcha.ready(() => {
                grecaptcha.execute(this.sitekey, { action: 'login' }).then((token) => {
                    this.token = token;
                    $wire.setCaptchaToken(token);
                });
            });
        }
    }"
    x-init="init()"
    x-on:reset-captcha.window="execute()"
    wire:ignore
>
</div>