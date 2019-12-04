interface Range {
  max: number;
  min: number;
}

export interface EncountableMonster {
  id: string;
  name: string;
  levelRange: Range;
  floorRange: Range;
}

export default interface Gate {
  id: string;
  name: string;
  encountableMonsters: EncountableMonster[];
}

export interface NewGate {
  name: string;
  encountableMonsters: EncountableMonster[];
}
