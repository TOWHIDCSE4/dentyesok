<template>
  <form v-loading="loading">
    <div class="card-body">
      <div class="form-group" :class="{ 'has-error': form.errors.has('current_password') }">
        <label for="exampleInputEmail1">既存パスワード</label>
        <input type="password" class="form-control" name="current_password" v-model="user.current_password" id="exampleInputEmail1"
               placeholder="既存パスワード" @change="inputChange">
        <span class="help-block" v-if="form.errors.has('current_password')">{{ form.errors.first('current_password') }}</span>
      </div>
      <div class="form-group" :class="{ 'has-error': form.errors.has('password') }">
        <label for="exampleInputPassword1">新しいパスワード</label>
        <input type="password" class="form-control" name="password" v-model="user.password" id="exampleInputPassword1"
               placeholder="新しいパスワード" @change="inputChange">
        <span class="help-block" v-if="form.errors.has('password')">{{ form.errors.first('password') }}</span>
      </div>
      <div class="form-group" :class="{ 'has-error': form.errors.has('password_confirmation') }">
        <label for="exampleInputPassword1">パスワード確認</label>
        <input type="password" class="form-control" name="password_confirmation" v-model="user.password_confirmation" id="exampleInputPassword1"
               placeholder="パスワード確認" @change="inputChange">
        <span class="help-block" v-if="form.errors.has('password_confirmation')">{{ form.errors.first('password_confirmation') }}</span>
      </div>
      <div class="form-group mt-2">
        <label></label>
        <button type="submit" @click.prevent="update" class="btn btn-primary">保存</button>
      </div>
    </div>
  </form>
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
    async update() {
      try {
        this.loading = true;
        this.form = new Form(this.user)
        await this.form.post(route('api.user.password.update'))
        this.user = {};
        this.loading = false;
      } catch (e) {
        console.log(e)
      } finally {
        this.loading = false;
      }
    },
    inputChange(event) {
        this.form.errors.clear(event.target.name)
    }
  },
}
</script>