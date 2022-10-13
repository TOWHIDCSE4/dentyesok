
<template>
	<!-- Default box -->
	<div class="card">
        <div class="card-header">
          <h3 class="card-title">Employee of Organization Information</h3><br>
		  <div class="card-title">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEmployeeModal" data-whatever="@mdo">Add New</button>
         </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
					   <th style="width: 5%">
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							  </span>
						</th>
                      <th style="width: 10%">
                          ID
                      </th>
                      <th style="width: 20%">
                          NAME
                      </th>
                      <th style="width: 20%">
                          ROLE
                      </th>
                      <th style="width: 45%">
						ACTION
                      </th>
                  </tr>
              </thead>
			  <tbody>
					<tr v-for="emp in employees" :key="emp.id">
					<td style="width: 5%">
					  <span class="custom-checkbox">
								<input type="checkbox" >
								<label for="selectAll"></label>
							  </span>
					</td>
					<td style="width: 10%">{{emp.id}}</td>
					<td style="width: 20%">{{emp.name}}</td>
					<td style="width: 20%">{{emp.role_id}}</td>
	<!--                <td>{{emp.role? emp.role.name: emp.role_id }}</td>-->
					<td style="width: 45%">
						<button @click.prevent="editEmployee(emp)" class="btn btn-primary">Edit</button>
						<button @click.prevent="deleteEmployee(emp.id)" class="btn btn-danger">Delete</button>
					</td>
				</tr>
			 </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
	</template>
	
	<script>
	import Form from 'form-backend-validation';
	
	export default {
	// 	components: {
	// 		Employee
	//   },
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
	
		async deleteFinally(){
		  // await axios.delete(`/api/employee/delete/${this.id}`).then((res)=>{
		  //   console.log(res)
		  //   // $('#deleteEmployeeModal').modal('hide')
		  //   // this.allData()
		  // }).catch((e)=>{
		  //   console.log(e)
		  // });
	
		}
	
	  },
	  mounted() {
		this.allData()
		this.getRoles()
	  }
	}
	</script>

