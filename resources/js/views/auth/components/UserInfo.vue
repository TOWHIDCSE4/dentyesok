<template>
  <form v-loading="loading">
    <div class="card-body">
      <div class="form-group" :class="{ 'has-error': form.errors.has('name') }">
        <label for="exampleInputEmail1">名前</label>
        <input type="text" class="form-control" name="name" v-model="user.name" id="exampleInputEmail1"
               placeholder="名前" @change="inputChange">
        <span class="help-block" v-if="form.errors.has('name')">{{ form.errors.first('name') }}</span>
      </div>
      <div class="form-group" :class="{ 'has-error': form.errors.has('email') }">
        <label for="exampleInputPassword1">メールアドレス</label>
        <input type="text" class="form-control" name="email" v-model="user.email" id="exampleInputPassword1"
               placeholder="メールアドレス" @change="inputChange">
        <span class="help-block" v-if="form.errors.has('email')">{{ form.errors.first('email') }}</span>
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
      loading: true
    }
  },
  methods: {
    async update() {
      try {
        this.loading = true;
        this.form = new Form(this.user)
        await this.form.post(route('api.user.profile.update'))
        this.loading = false;
      } catch (e) {
        console.log(e)
      } finally {
        this.loading = false;
      }
    },
    async getProfile() {
      const res = await axios.get(route('api.user.profile'))
      this.user = res.data;
      this.loading = false;
    },
    inputChange(event) {
        this.form.errors.clear(event.target.name)
    }
  },
  mounted() {
    this.getProfile()
  }
}
</script>