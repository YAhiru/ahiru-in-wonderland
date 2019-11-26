import { patch, get } from "../../../api";
import Gate from "../../../models/Gate";

export const show = async (id: string) => await get<Gate>(`/gates/${id}`);
export const update = async (gate: Gate) => await patch(`/gates/${gate.id}`, gate);
