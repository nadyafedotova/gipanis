<template>
    <div class="row justify-content-center align-items-center">
        <div class="col col-sm-8 align-self-center">
            <div class="card">
                <div class="card-header">
                    <strong>

                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    {{ html()->form('POST', route('auth.login.post'))->open() }}
                        <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                                    {{ html()->email('email')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.frontend.email'))
                        ->attribute('maxlength', 191)
                        ->required() }}
                                </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}

                                    {{ html()->password('password')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.frontend.password'))
                            ->required() }}
                                </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->

                    <div class="row">
                        <div class="col">
                            <div class="form-group clearfix">
                                {{ form_submit(__('labels.frontend.auth.login_button')) }}
                                </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->
                    {{ html()->form()->close() }}
                </div><!--card body-->
            </div><!--card-->
        </div><!-- col-md-8 -->
    </div><!-- row -->
</template>

<script>
    import LoginForm from '@vue-components/utils/LoginForm';
    export default {
        components: {
            LoginForm
        },
        created() {
            if(localStorage.getItem('auth_token')) {
                this.$router.push('/');
            }
        },
        data: function () {
            return {};
        },
    }
</script>