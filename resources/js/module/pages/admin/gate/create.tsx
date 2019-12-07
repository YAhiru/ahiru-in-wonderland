import React, { FC, useState, FormEvent, ChangeEvent } from "react";
import { useHistory } from "react-router-dom";
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

  const addEncountableMonster = () => {
    const newState = Object.assign({}, state);
    newState.encountableMonsters.push({
      id: "",
      name: "",
      levelRange: { max: 0, min: 0 },
      floorRange: { max: 0, min: 0 }
    });
    setState({ ...newState });
  };

  const handleSubmit = (event: FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    const gate: NewGate = { ...state };
    create(gate).then(res =>
      history.push("/admin" + res._links.self.href + "/edit")
    );
  };

  const monsterInputBoxStyle = {
    marginTop: "10px"
  };

  return (
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
      <button type={"button"} onClick={addEncountableMonster}>
        Add
      </button>
      <input type="submit" />
    </form>
  );
};

export default GateCreate;
