import React, {FC, useState, useEffect} from "react";
import Gate from "../../../models/Gate";
import {index, IndexResponse} from "../../../api/admin/gate/endpoints";
import { Link } from "react-router-dom";


interface GateCollection {
  gates: Gate[]
}
const GateIndex: FC = () => {

  const [state, setState] = useState<GateCollection>({
      gates: []
  });

  useEffect(() => {
    index().then((result: IndexResponse) => setState(result));
  }, []);

  return (
      <ul>
        {state.gates.map((gate: Gate) => (
            <li key={gate.id}><Link to={`/admin/gates/${gate.id}/edit`}>{gate.name}</Link></li>
        ))}
      </ul>
  );
};

export default GateIndex;
