import Home from '../components/HomeComponent'
import NotFound from '../components/NotFoundComponent'
import Dashboard from "../views/manager/Dashboard";
import Manager from "../layouts/Manager";
import Login from "../views/manager/auth/Login";
import Auth from "../layouts/Auth";
const routes = [
    {
        path: '*',
        component: NotFound
    },
    {
        path: '/',
        component: Home,
    },
    {
        path: '/manager/login',
        component: Login,
        meta :{ layout: Auth},
        name: 'managerLogin'
    },
    {
        path: '/manager',
        component: Dashboard,
        meta :{ layout: Manager},
        name: 'managerDashboard',
        beforeEnter:(to,from,next) => {
                    axios.get('/api/user').then(() => {
                        next()
                    }).catch(() => {
                        return next ({name:'managerLogin'})
                    })
                },
    },
    // {
    //     path: '/auth/login',
    //     component: LoginComponent,
    //     name: 'adminLogin',
    // },
    // {
    //     path: '/manager',
    //     component: DashboardComponent,
    //     name: 'adminDashboard',
    //     beforeEnter:(to,from,next) => {
    //         axios.get('/api/authenticated').then(() => {
    //             next()
    //         }).catch(() => {
    //             return next ({name:'adminLogin'})
    //         })
    //     },
    //     children : [
    //         {
    //             path: 'user',
    //             component: AdminUserListComponent,
    //             name: 'adminUser',
    //         },
    //     ],
    // },
];

export default routes;
