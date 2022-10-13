import dashboardRoutes from './views/dashboard'
import authRoutes from './views/auth'
import empolyeeRoutes from './views/employee'
import roleRoutes from './views/role'

export default [
    ...dashboardRoutes,
    ...authRoutes,
    ...empolyeeRoutes,
    ...roleRoutes
]