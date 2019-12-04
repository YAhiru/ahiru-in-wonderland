import React from "react";
import "./App.css";
import { BrowserRouter, Route, Link, Switch } from "react-router-dom";
import BattlePage from "./module/pages/battle";
import GateEdit from "./module/pages/admin/gate/edit";
import GateCreate from "./module/pages/admin/gate/create";
import GateIndex from "./module/pages/admin/gate";

const Home = () => (
  <div>
    <h2>Home</h2>
    <p>Ahiru in wonderland</p>
  </div>
);

const App: React.FC = () => {
  return (
    <BrowserRouter>
      <div>
        <ul>
          <li>
            <Link to="/">Home</Link>
          </li>
          <li>
            <Link to="/battle">battle</Link>
          </li>
          <li>
            <Link to="/admin/gates/create">gate create</Link>
          </li>
          <li>
            <Link to="/admin/gates">gate index</Link>
          </li>
        </ul>

        <hr />

        <Switch>
          <Route exact path="/" component={Home} />
          <Route exact path="/battle" component={BattlePage} />
          <Route exact path="/admin/gates" component={GateIndex} />
          <Route exact path="/admin/gates/:id/edit" component={GateEdit} />
          <Route exact path="/admin/gates/create" component={GateCreate} />
        </Switch>
      </div>
    </BrowserRouter>
  );
};

export default App;
