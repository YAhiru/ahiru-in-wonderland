import React from "react";
import "./App.css";
import { BrowserRouter, Route, Link } from "react-router-dom";
import BattlePage from "./module/pages/battle";

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
        </ul>

        <hr />

        <Route exact path="/" component={Home} />
        <Route path="/battle" component={BattlePage} />
      </div>
    </BrowserRouter>
  );
};

export default App;
