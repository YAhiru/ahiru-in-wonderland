import React, { FC, useState, useEffect, FormEvent, ChangeEvent } from "react";
import { RouteComponentProps } from "react-router-dom";
import Gate, { EncountableMonster } from "../../../models/Gate";
import { update, show } from "../../../api/admin/gate/endpoints";

interface FormProps {
  name: string;
  encountableMonsters: EncountableMonster[];
}

type RouteProps = RouteComponentProps<{ id: string }>;

const GateEdit: FC<RouteProps> = props => {
  const gateId = props.match.params.id;
  const [state, setState] = useState<FormProps>({
    name: "",
    encountableMonsters: []
  });

  useEffect(() => {
    show(gateId).then((gate: Gate) => {
      setState({
        name: gate.name,
        encountableMonsters: gate.encountableMonsters
      });
    });
  }, []);

  const handleChange = (event: ChangeEvent<HTMLInputElement>) => {
    setState({ ...state, [event.target.name]: event.target.value });
  };

  const handleSubmit = (event: FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    const gate: Gate = { id: gateId, ...state };
    update(gate);
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

export default GateEdit;
