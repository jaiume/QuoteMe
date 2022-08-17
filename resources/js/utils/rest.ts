import { CustomError } from 'ts-custom-error';

export class HttpException extends CustomError {
  constructor(status: number, message: string) {
    super(message);
  }
}

export class Rest {
  static request<T = any>(method: 'GET' | 'POST', endpoint: string, data?: Record<string, any>): Promise<T> {
    return new Promise((resolve, reject) => {
      const xhr = new XMLHttpRequest();

      if (method === 'GET' && data) {
        let params = '';
        Object.keys(data).forEach(key => {
          params += `${key}=${encodeURIComponent(data[key])}`;
        });

        xhr.open(method, `${endpoint}?${params}`, true);
      } else {
        xhr.open(method, endpoint);
      }

      if (method === 'POST' && data) {
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      }

      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

      const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
      if (csrf) {
        xhr.setRequestHeader('X-CSRF-TOKEN', csrf);
      }

      xhr.onload = function () {
        if (xhr.status !== 200) {
          reject(new HttpException(this.status, this.statusText));
        } else {
          if (xhr.getResponseHeader('Content-Type') === 'application/json') {
            resolve(JSON.parse(xhr.response) as T);
          } else {
            resolve(xhr.response);
          }
        }
      };

      xhr.onerror = function () {
        reject(new HttpException(this.status, this.statusText));
      };

      if (method === 'POST' && data) {
        let body = '';
        Object.keys(data).forEach(key => {
          body += `${key}=${encodeURIComponent(data[key])}`;
        });

        xhr.send(body);
      } else {
        xhr.send();
      }
    });
  }

  static async get<T = any>(endpoint: string, params?: Record<string, any>): Promise<T> {
    return await Rest.request<T>('GET', endpoint, params);
  }

  static async post<T = any>(endpoint: string, data: Record<string, any>): Promise<T> {
    return await Rest.request<T>('POST', endpoint, data);
  }
}
