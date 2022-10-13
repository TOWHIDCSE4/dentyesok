<template>
  <section class="content">
    <div class="container-fluid">
      <div class="card card-outline">
        <div class="card-body">
          <h4>プロファイル情報</h4>
          <div class="row">
            <div class="col-5 col-sm-3">
              <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" @click="changeTab(1)" id="vert-tabs-home-tab" data-toggle="pill"
                   href="#vert-tabs-home" role="tab" aria-selected="true">一般情報</a>
                <a class="nav-link" @click="changeTab(2)" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab"
                   aria-selected="false">個人情報</a>
                <a class="nav-link" @click="changeTab(3)" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab"
                   aria-selected="false">パスワードの変更</a>
                <a class="nav-link" @click="changeTab(4)" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab"
                   aria-selected="false">決済</a>
              </div>
            </div>
            <div class="col-7 col-sm-9">
              <div class="tab-content" id="vert-tabs-tabContent">
                <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel"
                     aria-labelledby="vert-tabs-home-tab">
                  <OrganizationInfo />
                </div>
                <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel"
                     aria-labelledby="vert-tabs-profile-tab">
                  <UserInfo v-if="tabs.indexOf(2)>-1"/>
                </div>
                <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel"
                     aria-labelledby="vert-tabs-messages-tab">
                  <Password v-if="tabs.indexOf(3)>-1" />
                </div>
                <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel"
                     aria-labelledby="vert-tabs-settings-tab">
                  payment
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import UserInfo from './components/UserInfo'
import OrganizationInfo from "./components/OrganizationInfo";
import Password from "./components/Password";

export default {
  components: {
    UserInfo, OrganizationInfo, Password
  },
  data() {
    return {
      tabs: []
    }
  },
  methods: {
    changeTab(x) {
      if (this.tabs.indexOf(x)===-1) {
        this.tabs.push(x)
      }
    },
  }
}
</script>