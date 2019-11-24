import React, { FC, useState, useEffect } from "react";
import { encount } from "../../api/battle/endpoints";
import Battle from "../../models/Battle";

const BattlePage: FC = () => {
  const [battle, setBattle] = useState<Battle>({
    id: "",
    enemies: [],
    monsters: []
  });

  useEffect(() => {
    encount().then(data => {
      setBattle(data);
    });
  }, []);

  if (battle.id === "") {
    return <div>Loading...</div>;
  }

  return (
    <div>
      <h3>id: {battle.id}</h3>
      <h3>Enemies</h3>
      <ul>
        {battle.enemies.map(enemy => (
          <li>{enemy.name}</li>
        ))}
      </ul>
      <h3>Monsters</h3>
      <ul>
        {battle.monsters.map(monster => (
          <li>
            {monster.name} HP:{monster.hp} MP: {monster.mp}
          </li>
        ))}
      </ul>
    </div>
  );
};

export default BattlePage;
