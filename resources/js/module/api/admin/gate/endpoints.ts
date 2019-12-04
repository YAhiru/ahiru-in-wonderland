import { patch, get, post } from "../../../api";
import Gate, { NewGate } from "../../../models/Gate";

export const show = async (id: string) => await get<Gate>(`/gates/${id}`);
export const create = async (gate: NewGate) => await post<Gate>(`/gates`, gate);
export const update = async (gate: Gate) => await patch(`/gates/${gate.id}`, gate);
