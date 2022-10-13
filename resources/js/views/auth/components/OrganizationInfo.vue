<template>
  <form v-loading="loading">
    <div class="card-body">
      <div class="form-group" :class="{ 'has-error': form.errors.has('name') }">
        <label for="exampleInputEmail1">法人名/医院名</label>
        <input type="text" class="form-control" name="name" v-model="organization.name" id="exampleInputEmail1"
               placeholder="法人名/医院名" @change="inputChange">
        <span class="help-block" v-if="form.errors.has('name')">{{ form.errors.first('name') }}</span>
      </div>
      <div class="form-group" :class="{ 'has-error': form.errors.has('address') }">
        <label for="exampleInputPassword1">住所</label>
        <input type="text" class="form-control" name="address" v-model="organization.address" id="exampleInputPassword1"
               placeholder="住所" @change="inputChange">
        <span class="help-block" v-if="form.errors.has('address')">{{ form.errors.first('address') }}</span>
      </div>
      <div class="form-group" :class="{ 'has-error': form.errors.has('number_branch') }">
        <label for="exampleInputPassword1">医院数</label>
        <input type="text" class="form-control" name="address" v-model="organization.number_branch" id="exampleInputPassword1"
               placeholder="医院数" @change="inputChange">
        <span class="help-block" v-if="form.errors.has('number_branch')">{{ form.errors.first('number_branch') }}</span>
      </div>
      <div class="form-group" :class="{ 'has-error': form.errors.has('settlement_month') }">
        <label for="exampleInputPassword1">決算月</label>
        <input type="text" class="form-control" name="settlement_month" v-model="organization.settlement_month" id="exampleInputPassword1"
               placeholder="決算月" @change="inputChange">
        <span class="help-block" v-if="form.errors.has('settlement_month')">{{ form.errors.first('settlement_month') }}</span>
      </div>
      <div class="form-group" :class="{ 'has-error': form.errors.has('started_at') }">
        <label for="exampleInputPassword1">開業年</label>
        <input type="text" class="form-control" name="started_at" v-model="organization.started_at" id="exampleInputPassword1"
               placeholder="開業年" @change="inputChange">
        <span class="help-block" v-if="form.errors.has('started_at')">{{ form.errors.first('started_at') }}</span>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Status</label>
        <p>{{ organization.status | comStatus }}</p>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Expiration Date</label>
        <p>{{ organization.expiration_date | dateFormat }}</p>
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
      organization: {},
      form: new Form(),
      loading: true
    }
  },
  methods: {
    async update() {
      try {
        this.loading = true;
        this.form = new Form(this.organization)
        await this.form.post(route('api.com.profile.update'))
        this.loading = false;
      } catch (e) {
        console.log(e)
      } finally {
        this.loading = false;
      }
    },
    async getProfile() {
      const res = await axios.get(route('api.com.profile'))
      this.organization = res.data;
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