export function debounce<T extends Function>(cb: T, wait = 500): T {
  let h: NodeJS.Timeout;

  const callable = (...args: any) => {
    clearTimeout(h);
    h = setTimeout(() => cb(...args), wait);
  };

  return (callable as any) as T;
}
