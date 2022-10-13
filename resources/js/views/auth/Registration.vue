<template>
  <div class="register-card-body" v-loading="loading">
    <div class="card card-outline card-primary text-center" style="border-color: white;">
      <div class="card-header text-center">
        <a href="" class="h1"><b>新規会員登録</b></a>
      </div>
      <div class="card-body">
        <form action="" method="post">
          <div class="row mb-2">
            <div class="col-6">
              <div class="icheck-primary">
                <input type="radio" name="type" v-model="organization.type" value="1" id="org">
                <label for="org">
                  医療法人
                </label>
              </div>
            </div>
            <div class="col-6">
              <div class="icheck-primary">
                <input type="radio" name="type" v-model="organization.type" value="2" id="personal">
                <label for="personal">
                  個人事業主
                </label>
              </div>
            </div>
            <span class="help-block" v-if="form.errors.has('type')">{{ form.errors.first('type') }}</span>
          </div>
          <div class="form-group row" :class="{ 'has-error': form.errors.has('name') }">
            <label for="inputEmail3" class="col-sm-4 col-form-label required">法人名/医院名</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="name" v-model="organization.name" id="inputEmail3" placeholder="">
              <span class="help-block" v-if="form.errors.has('name')">{{ form.errors.first('name') }}</span>
            </div>
          </div>
          <div class="form-group row" :class="{ 'has-error': form.errors.has('number_branch') }">
            <label for="inputEmail3" class="col-sm-4 col-form-label required">医院数</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="number_branch" v-model="organization.number_branch" id="inputEmail3" placeholder="">
              <span class="help-block" v-if="form.errors.has('number_branch')">{{ form.errors.first('number_branch') }}</span>
            </div>
          </div>
          <div class="form-group row" :class="{ 'has-error': form.errors.has('address') }">
            <label for="inputEmail3" class="col-sm-4 col-form-label required">住所</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="address" v-model="organization.address" id="inputEmail3" placeholder="">
              <span class="help-block" v-if="form.errors.has('address')">{{ form.errors.first('address') }}</span>
            </div>
          </div>
          <div class="form-group row" :class="{ 'has-error': form.errors.has('user_name') }">
            <label for="inputEmail3" class="col-sm-4 col-form-label required">理事長名/院長名</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="user_name" v-model="organization.user_name" id="inputEmail3" placeholder="">
              <span class="help-block" v-if="form.errors.has('user_name')">{{ form.errors.first('user_name') }}</span>
            </div>
          </div>
          <div class="form-group row" :class="{ 'has-error': form.errors.has('settlement_month') }">
            <label for="inputEmail3" class="col-sm-4 col-form-label required">決算月</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="settlement_month" v-model="organization.settlement_month" id="inputEmail3" placeholder="">
              <span class="help-block" v-if="form.errors.has('settlement_month')">{{ form.errors.first('settlement_month') }}</span>
            </div>
          </div>
          <div class="form-group row" :class="{ 'has-error': form.errors.has('email') }">
            <label for="inputEmail3" class="col-sm-4 col-form-label required">メールアドレス（経営者ID）</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="email" v-model="organization.email" id="inputEmail3" placeholder="">
              <span class="help-block" v-if="form.errors.has('email')">{{ form.errors.first('email') }}</span>
            </div>
          </div>
          <div class="form-group row" :class="{ 'has-error': form.errors.has('password') }">
            <label for="inputEmail3" class="col-sm-4 col-form-label required">パスワード</label>
            <div class="col-sm-8">
              <input type="password" class="form-control" name="password" v-model="organization.password" id="inputEmail3" placeholder="">
              <span class="help-block" v-if="form.errors.has('password')">{{ form.errors.first('password') }}</span>
            </div>
          </div>
          <div class="form-group row" :class="{ 'has-error': form.errors.has('password_confirmation') }">
            <label for="inputEmail3" class="col-sm-4 col-form-label required">パスワード確認</label>
            <div class="col-sm-8">
              <input type="password" class="form-control" name="password_confirmation" v-model="organization.password_confirmation" id="inputEmail3" placeholder="">
              <span class="help-block" v-if="form.errors.has('password_confirmation')">{{ form.errors.first('password_confirmation') }}</span>
            </div>
          </div>
          <div class="form-group row" :class="{ 'has-error': form.errors.has('size') }">
            <label for="inputEmail3" class="col-sm-4 col-form-label required">売上規模（法人全体）</label>
            <div class="col-sm-2">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="size" v-model="organization.size" value="1" id="flexCheckDefault1">
                <label class="form-check-label" for="flexCheckDefault1">
                  5,000万円未満
                </label>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="size"  v-model="organization.size" value="2" id="flexCheckDefault2">
                <label class="form-check-label" for="flexCheckDefault2">
                  1億円未満
                </label>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="size"  v-model="organization.size" value="3" id="flexCheckDefault3">
                <label class="form-check-label" for="flexCheckDefault3">
                  2億円未満
                </label>
              </div>
            </div>
          </div>
          <div class="row second-row">
            <div class="col-sm-2">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="size"  v-model="organization.size" value="4" id="flexCheckDefault4">
                <label class="form-check-label" for="flexCheckDefault4">
                  3億円未満
                </label>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="size" v-model="organization.size" value="5" id="flexCheckDefault5">
                <label class="form-check-label" for="flexCheckDefault5">
                  4億円未満
                </label>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="size" v-model="organization.size" value="6" id="flexCheckDefault6">
                <label class="form-check-label" for="flexCheckDefault6">
                  5億円未満
                </label>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-check">
                <input class="form-check-input" type="radio" v-model="organization.size" value="7" id="flexCheckDefault7">
                <label class="form-check-label" for="flexCheckDefault7">
                  5億円以上
                </label>
              </div>
            </div>
          </div>
          <span class="help-block" v-if="form.errors.has('size')">{{ form.errors.first('size') }}</span>
          <div class="col-4" style="
            margin-left: 32%;
          ">
            <button type="submit" @click.prevent="submit" class="btn btn-primary btn-block">入力内容確認</button>
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</template>
<style>
.register-card-body {
  position: absolute;
  top: 20%;
  left: 50%;
  margin-right: -50%;
  transform: translate(-50%, 25%);
  width: 720px;
  margin-top: -10%;
  color: black;
}

.required:after {
  content: " *";
  color: blue;
}

.second-row {
  margin-left: 33%;
  width: 98%;
  margin-bottom: 10px;
}
</style>
<script>
import Form from 'form-backend-validation';

export default {
  data() {
    return {
      organization: {},
      form: new Form(),
      loading: false
    }
  },
  methods: {
    async submit() {
      try {
        this.loading = true;
        this.form = new Form(this.organization)
        await this.form.post(route('api.customer.register'))
        alert("register success. Please check your email.")
      } catch (e) {
        console.log(e)
      } finally {
        this.loading = false;
      }
    }
  }
}
</script>