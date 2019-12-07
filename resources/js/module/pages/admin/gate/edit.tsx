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
  }, [gateId]);

  const handleChangeName = (event: ChangeEvent<HTMLInputElement>) => {
    setState({ ...state, [event.target.name]: event.target.value });
  };

  const handleChangeMonsterName = (idx: number) => {
    return (event: ChangeEvent<HTMLInputElement>) => {
      const newState = Object.assign({}, state);
      newState.encountableMonsters[idx].name = event.target.value;
      setState({ ...newState });
    };
  };

  const handleChangeMonsterFloorMax = (idx: number) => {
    return (event: ChangeEvent<HTMLInputElement>) => {
      const newState = Object.assign({}, state);
      newState.encountableMonsters[idx].floorRange.max = parseInt(
        event.target.value
      );
      setState({ ...newState });
    };
  };

  const handleChangeMonsterFloorMin = (idx: number) => {
    return (event: ChangeEvent<HTMLInputElement>) => {
      const newState = Object.assign({}, state);
      newState.encountableMonsters[idx].floorRange.min = parseInt(
        event.target.value
      );
      setState({ ...newState });
    };
  };

  const handleChangeMonsterLevelMax = (idx: number) => {
    return (event: ChangeEvent<HTMLInputElement>) => {
      const newState = Object.assign({}, state);
      newState.encountableMonsters[idx].levelRange.max = parseInt(
        event.target.value
      );
      setState({ ...newState });
    };
  };

  const handleChangeMonsterLevelMin = (idx: number) => {
    return (event: ChangeEvent<HTMLInputElement>) => {
      const newState = Object.assign({}, state);
      newState.encountableMonsters[idx].levelRange.min = parseInt(
        event.target.value
      );
      setState({ ...newState });
    };
  };

  const handleSubmit = (event: FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    const gate: Gate = { id: gateId, ...state };
    update(gate);
  };

  const monsterInputBoxStyle = {
    marginTop: "10px"
  };

  return state.name ? (
    <form onSubmit={handleSubmit}>
      <input
        type="text"
        name="name"
        value={state.name}
        onChange={handleChangeName}
      />
      {state.encountableMonsters.map((m, key) => (
        <div style={monsterInputBoxStyle} key={key}>
          {m.name}
          <br />
          <input type="hidden" value={m.id} />
          <input
            type="text"
            value={m.name}
            onChange={handleChangeMonsterName(key)}
          />
          <label>Floor </label>
          <input
            type="text"
            value={m.floorRange.min}
            onChange={handleChangeMonsterFloorMin(key)}
          />
          <input
            type="text"
            value={m.floorRange.max}
            onChange={handleChangeMonsterFloorMax(key)}
          />
          <label>Level </label>
          <input
            type="text"
            value={m.levelRange.min}
            onChange={handleChangeMonsterLevelMin(key)}
          />
          <input
            type="text"
            value={m.levelRange.max}
            onChange={handleChangeMonsterLevelMax(key)}
          />
        </div>
      ))}
      <input type="submit" />
    </form>
  ) : (
    <div>Loading...</div>
  );
};

export default GateEdit;
