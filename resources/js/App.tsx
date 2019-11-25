import React from "react";
import "./App.css";
import { BrowserRouter, Route, Link } from "react-router-dom";
import BattlePage from "./module/pages/battle";
import GateEdit from "./module/pages/admin/gate/edit";

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
            <Link to="/admin/gate/1/edit">gate edit</Link>
          </li>
        </ul>

        <hr />

        <Route exact path="/" component={Home} />
        <Route path="/battle" component={BattlePage} />
        <Route path="/admin/gate/:id/edit" component={GateEdit} />
      </div>
    </BrowserRouter>
  );
};

export default App;
