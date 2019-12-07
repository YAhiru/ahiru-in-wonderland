import { patch, get, post } from "../../../api";
import Gate, { NewGate } from "../../../models/Gate";

interface SelfLink {
  self: {
    href: string;
  };
}
export const show = async (id: string) => await get<Gate>(`/gates/${id}`);

export type CreateResponse = Gate & { _links: SelfLink };
export const create = async (gate: NewGate) =>
  await post<CreateResponse>(`/gate`, gate);
export const update = async (gate: Gate) =>
  await patch(`/gates/${gate.id}`, gate);

export interface IndexResponse {
  gates: Gate[];
  _links: SelfLink;
}
export const index = async () => await get<IndexResponse>("/gates");
