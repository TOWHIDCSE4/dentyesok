
<template>
  <section class="content">
    <!-- Default box -->
	<div class="card">
        <div class="card-header">
          <h3 class="card-title">Projects</h3>
		  <div class="card-tools">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add New</button>
         </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 10%">
                          ID
                      </th>
                      <th style="width: 20%">
                          NAME
                      </th>
                  </tr>
              </thead>
			  <tbody>
					<tr v-for="role in roles" :key="role.id">
					<td style="width: 10%">{{role.id}}</td>
					<td style="width: 20%">{{role.name}}</td>
					<td style="width: 45%">
						<button @click.prevent="editEmployee(role)" class="btn btn-primary">Edit</button>
						<button @click.prevent="deleteEmployee(role.id)" class="btn btn-danger">Delete</button>
					</td>
				</tr>
			 </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
  </section>
</template>


<script>
import axios from 'axios';
import Form from 'form-backend-validation';

export default {
  data() {
    return {
      role: {},
      form: new Form(),
      loading: true
    }
  },
  methods: {
	async createRole() {
      try {
        this.loading = true;
        this.form = new Form(this.role)
        await this.form.post(route('api.role.createRole'))
      } catch (e) {
        console.log(e)
      } finally {
        this.loading = false;
      }
    },
    async updateRole() {
      try {
        this.loading = true;
        this.form = new Form(this.role)
        await this.form.post(route('api.role.updateRole'))
        this.loading = false;
      } catch (e) {
        console.log(e)
      } finally {
        this.loading = false;
      }
    },
    async allData() {
      const res = await axios.get(route('api.role.allData'))
      this.role = res.data;
      this.loading = false;
    },
    async DeleteRole(id){
      const res= await axios.post(route('api.role.deleteRole'))
      this.role=res.data;
      this.loading=false;
    }
  },
  mounted() {
    this.allData()
  }
}
</script>
