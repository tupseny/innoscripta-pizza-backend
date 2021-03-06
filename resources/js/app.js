import React from 'react';
import 'bootswatch/dist/journal/bootstrap.min.css'
import {Menu} from "./components/menu";
import {Cart} from "./components/cart"
import {NavbarPizza} from "./components/navigation";
import {PizzaAlert} from "./components/other/alert";
import {AppContext} from "./components/app-with-context";
import {Register, Login} from "./components/auth/";
import {InitApp} from "./components/init-app";
import {BrowserRouter} from "react-router-dom";
import {Redirect, Route} from "react-router";
import {CONFIG} from "./helpers/config";
import {PizzaFooter} from "./components/navigation/footer/footer";
import {OrderHistory} from "./components/profile/order-history";
import {Home} from "./components/home";
import ReactDOM from "react-dom";
import * as serviceWorker from "./serviceWorker";

require('./bootstrap');

function App() {
    return (
        <BrowserRouter>
            <AppContext>
                <InitApp/>
                <NavbarPizza/>
                <Route path={CONFIG.paths.home} component={Home}/>
                <Route path={CONFIG.paths.menu} component={Menu}/>
                <Route path={CONFIG.paths.login} component={Login}/>
                <Route path={CONFIG.paths.signup} component={Register}/>
                <Route path={CONFIG.paths.cart} component={Cart}/>
                <Route path={CONFIG.paths.history} component={OrderHistory}/>
                <Redirect to={'/home'} from={'/'}/>
                <PizzaAlert timeout={3000}/>
                <PizzaFooter/>
            </AppContext>
        </BrowserRouter>
    );
}

export default App;

ReactDOM.render(
    <App/>,
    document.getElementById('root')
);

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
serviceWorker.register();
