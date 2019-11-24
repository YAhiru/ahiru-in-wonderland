export interface Monster {
  id: string;
  name: string;
  level: number;
  hp: number;
  mp: number;
}

export interface Enemy {
  id: string;
  name: string;
}

export default interface Battle {
  id: string;
  enemies: Enemy[];
  monsters: Monster[];
}
