import React, { FC, useState, FormEvent, ChangeEvent } from "react";
import {useHistory} from "react-router-dom";
import { EncountableMonster, NewGate } from "../../../models/Gate";
import { create } from "../../../api/admin/gate/endpoints";

interface FormProps {
  name: string;
  encountableMonsters: EncountableMonster[];
}

const GateCreate: FC = () => {
  const history = useHistory();
  const [state, setState] = useState<FormProps>({
    name: "",
    encountableMonsters: []
  });

  const handleChange = (event: ChangeEvent<HTMLInputElement>) => {
    setState({ ...state, [event.target.name]: event.target.value });
  };

  const handleSubmit = (event: FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    const gate: NewGate = { ...state };
    create(gate).then(res => history.push('/gates/' + res.id));
  };

  return (
    <form onSubmit={handleSubmit}>
      <input
        type="text"
        name="name"
        value={state.name}
        onChange={handleChange}
      />
      <input type="submit" />
    </form>
  );
};

export default GateCreate;
