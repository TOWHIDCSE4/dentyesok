
<template>
	<!-- Default box -->
	<div class="card">
        <div class="card-header clearfix">
          <h3 class="card-title">Employee of Organization Information</h3><br>
          <button type="button" class="btn btn-primary card-title" data-toggle="modal" data-target="#addEmployeeModal" data-whatever="@mdo">Add New</button>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped table-hover">
            <thead>
            <tr>
              <th>
                <span class="custom-checkbox">
                  <input type="checkbox" id="selectAll">
                  <label for="selectAll"></label>
                </span>
              </th>
              <th>ID</th>
              <th>Name</th>
              <th>Role</th>
              <th style="width: 250px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(emp,index) in employees" :key="emp.id">
              <td>
                  <span class="custom-checkbox">
                    <input type="checkbox" >
                    <label for="selectAll"></label>
                  </span>
              </td>
              <td>{{index + 1 }}</td>
              <td>{{emp.name}}</td>
              <td>
                <span class="badge badge-success">{{emp.role ? emp.role.name : emp.role_id }}</span>
              </td>
              <td>
                <button @click.prevent="editEmployee(emp)" class="btn btn-primary btn-sm">
                  <i class="fa fa-edit" style="font-size: 12px;"></i> Edit
                </button>
                <button @click.prevent="deleteEmployee(emp.id)" class="btn btn-danger btn-sm">
                  <i class="fa fa-trash" style="font-size: 12px;"></i> Delete
                </button>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->

    <!-- Add Modal HTML -->
    <div id="addEmployeeModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <form v-loading="loading">
            <div class="modal-header">
              <h4 class="modal-title">Add Employee</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" v-model="form.name" required>
              </div>
              <div class="form-group">
                <label for="role_id">Select Role</label>
                <select v-model="form.role_id" name="role_id" id="role_id" class="form-control">
                  <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
              <button @click.prevent="createEmployee" class="btn btn-success">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editEmployeeModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <form v-loading="loading">
            <div class="modal-header">
              <h4 class="modal-title">Edit Employee</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control"  name="name" v-model="form.name" required>
              </div>
              <div class="form-group">
                <label for="role_id">Select Role</label>
                <select v-model="form.role_id" name="role_id" id="role_id" class="form-control">
                  <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
              <button @click.prevent="updateEmployee" class="btn btn-success">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- <form> -->
          <div class="modal-header">
            <h4 class="modal-title">Delete Employee</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete these Records?</p>
            <p class="text-warning"><small>This action cannot be undone.</small></p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <button @click="employeeDeleted" type="button" class="btn btn-danger">Delete</button>
          </div>
          <!-- </form> -->
        </div>
      </div>
    </div>

      </div>
      <!-- /.card -->
	</template>

<script>
import Form from 'form-backend-validation';

export default {

  data() {
    return {
      form: new Form({
        name: '',
        role_id: ''
      }),
      id: '',
      roles : [],
      employees: [],
      loading: true,

    }
  },
  methods: {
    async allData() {
      const res = await axios.get(route('api.employee.allData'));
      this.employees = res.data.data;
      this.loading = false;
    },
    async getRoles(){
      const res = await axios.get(route('api.role.roleList'));
      this.roles = res.data.roles;
    },

    async createEmployee() {
      try {
        this.loading = true;
        await this.form.post(route('api.employee.createEmployee'))
        $('#addEmployeeModal').modal('hide')
        this.clearForm()
        this.allData();

      } catch (e) {
        console.log(e)
      } finally {
        this.loading = false;
      }
    },
    async editEmployee(emp){
      $('#editEmployeeModal').modal('show')
      this.form.name = emp.name
      this.form.role_id = emp.role_id
      this.id = emp.id;
    },

    async updateEmployee() {
      try {
        this.loading = true;
        await this.form.post(`/api/employees/update/${this.id}`)
        $('#editEmployeeModal').modal('hide')
        this.clearForm()
        this.allData();
        this.loading = false;
      } catch (e) {
        console.log(e)
      } finally {
        this.loading = false;
      }
    },

    async deleteEmployee(id){
      this.id = id;
      $('#deleteEmployeeModal').modal('show')
    },

    async employeeDeleted(){
      await axios.delete(`/api/employee/delete/${this.id}`).then((res)=>{
        $('#deleteEmployeeModal').modal('hide')
        this.allData()
      }).catch((e)=>{
        console.log(e)
      });

    },
    clearForm(){
      this.form.name = '';
      this.form.role_id = '';
    }

  },
  mounted() {
    this.allData()
    this.getRoles()
  }
}
</script>

