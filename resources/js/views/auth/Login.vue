<template>
  <div v-loading="loading">
    <div class="login-logo">
      <span>ログイン</span>
    </div>
    <div class="card">
      <div class="card-body login-card-body">

        <form method="post">
          <div class=" mb-3" :class="{ 'has-error': form.errors.has('email') }">
            <input type="email" class="form-control" name="email" v-model="user.email" placeholder="メール">

            <span class="help-block" v-if="form.errors.has('email')">{{ form.errors.first('password') }}</span>
          </div>
          <div class="mb-3" :class="{ 'has-error': form.errors.has('name') }">
            <input type="password" class="form-control" name="password" v-model="user.password" placeholder="パスワード">

            <span class="help-block" v-if="form.errors.has('password')">{{ form.errors.first('password') }}</span>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  ログイン情報を保持する
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-12 text-center">
              <button type="submit" @click.prevent="postLogin" class="btn btn-primary btn-block">ログイン</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mb-1 mt-3 text-right">
          <a href="forgot-password.html">＞ID・パスワードを忘れた方</a>
        </p>
        <p class="mb-0 mt-5 text-center">
          <router-link :to="{ name: 'register'}" class="text-center">新規会員登録はこちら</router-link>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'form-backend-validation';

export default {
  data() {
    return {
      user: {},
      form: new Form(),
      loading: false
    }
  },
  methods: {
    async postLogin() {
      try {
        this.loading = true;
        this.form = new Form(this.user)
        await this.form.post(route('api.customer.login'))
        window.location.href = '/home'
      } catch (e) {
        console.log(e)
      } finally {
        this.loading = false;
      }
    }
  },

}
</script>