/**
 * Json関連
 */

/** jsonのクローンを生成 */
export function clone(original) {
  const clone = JSON.parse(JSON.stringify(original));
  return clone;
}
