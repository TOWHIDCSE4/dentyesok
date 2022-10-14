
<template>
  <section class="content">
    <!-- Default box -->
	<div class="card">
        <div class="card-header">
          <h3 class="card-title">Projects</h3>
		  <div class="card-tools">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal" data-whatever="@mdo">Add New</button>
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
					<tr v-for="(role,index) in roles" :key="role.id">
					<td style="width: 10%">{{index + 1}}</td>
					<td style="width: 20%">{{role.name}}</td>
					<td style="width: 45%">
						<button @click.prevent="editRole(role)" class="btn btn-primary">Edit</button>
<!--						<button @click.prevent="deleteRole(role.id)" class="btn btn-danger">Delete</button>-->
					</td>
				</tr>
			 </tbody>
          </table>
        </div>
        <!-- /.card-body -->


    <!-- Add Modal HTML -->
    <div id="addModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <form v-loading="loading">
            <div class="modal-header">
              <h4 class="modal-title">Add Role</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" v-model="form.name" required>
              </div>
            </div>
            <div class="modal-footer">
              <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
              <button @click.prevent="createRole" class="btn btn-success">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <form v-loading="loading">
            <div class="modal-header">
              <h4 class="modal-title">Edit Role</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control"  name="name" v-model="form.name" required>
              </div>
            </div>
            <div class="modal-footer">
              <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
              <button @click.prevent="updateRole" class="btn btn-success">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- <form> -->
          <div class="modal-header">
            <h4 class="modal-title">Delete Role</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete these Records?</p>
            <p class="text-warning"><small>This action cannot be undone.</small></p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <button @click="deletedRole" type="button" class="btn btn-danger">Delete</button>
          </div>
          <!-- </form> -->
        </div>
      </div>
    </div>

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
      form: new Form({
        name: '',
      }),
      id: '',
      roles: [],
      loading: false,
    }
  },
  methods: {
    async getRoles(){
      const res = await axios.get(route('api.role.roleList'));
      this.roles = res.data.roles;
    },
	  async createRole() {
      try {
        this.loading = true;
        await this.form.post(route('api.role.createRole'))
        $('#addModal').modal('hide');
        this.clearForm();
        this.getRoles();
        this.loading = false;
      } catch (e) {
        console.log(e)
      } finally {
        this.loading = false;
      }
    },
    editRole(role){
      this.id = role.id;
      this.form.name = role.name;
      $('#editModal').modal('show');
    },
    async updateRole() {
      try {
        this.loading = true;
        await this.form.post(route('api.role.updateRole',this.id))
        $('#editModal').modal('hide');
        this.clearForm();
        this.getRoles();
        this.loading = false;
      } catch (e) {
        console.log(e)
      } finally {
        this.loading = false;
      }
    },

    async deleteRole(id){
      this.id = id;
      $('#deleteModal').modal('show');
    },
    async deletedRole(){
      await axios.delete(route('api.role.deleteRole',this.id))
      $('#deleteModal').modal('hide');
      this.getRoles();
      this.loading=false;
    },
    clearForm(){
      this.form.name = '';
    }
  },
  mounted() {
    this.getRoles()
  }
}
</script>
