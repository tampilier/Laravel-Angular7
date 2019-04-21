import { Component } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {

  x_access_token:string = 'jygVPpJFRcJAK2q9UZkEn4s4L29hLgaZt2EvTHgzmEoI91FcKzyrDD0beVV2';
  baseUrl:string = 'http://192.168.56.12:80/';
  responce:string = '';


  constructor(private httpClient : HttpClient) {}

  ngOnInit() {}

  setLogIn() {
    this
        .httpClient
        .post(
            this.baseUrl+'api/v1/users/login',
            {login: 'admin', password: '123'}
          )
        .subscribe((res : any[]) => {
          console.log('Responce: ',res);
          this.responce = res && res.toString() || '';
        });
  }

  setUserMe() {
    this
        .httpClient
        .get(
            this.baseUrl+'api/v1/users/me',
            {headers: new HttpHeaders({'x-access-token': this.x_access_token})}
        )
        .subscribe((res : any[]) => {
          console.log('Responce: ',res);
          this.responce = res && res.toString() || '';
        });
  }

  getAllProducts() {//console.log('Token: ',this.x_access_token);
    this
        .httpClient
        .get(
            this.baseUrl+'api/v1/products',
            {headers: new HttpHeaders({'x-access-token': this.x_access_token})}
        )
        .subscribe((res : any[]) => {
          console.log('Responce: ',res);
          this.responce = res && res.toString() || '';
        });
  }

  getProduct() {
    this
        .httpClient
        .get(
            this.baseUrl+'api/v1/products/1',
            {headers: new HttpHeaders({'x-access-token': this.x_access_token})}
          )
        .subscribe((res : any[]) => {
          console.log('Responce: ',res);
          this.responce = res && res.toString() || '';
        });
  }

  createProduct() {
    this
        .httpClient
        .post(
            this.baseUrl+'api/v1/products',
            {name: 'A2', price: 10, amount: 1},
            {headers: new HttpHeaders({'x-access-token': this.x_access_token})}
        )
        .subscribe((res : any[]) => {
          console.log('Responce: ',res);
          this.responce = res && res.toString() || '';
        });
  }

  updateProduct() {
    this
        .httpClient
        .put(
            this.baseUrl+'api/v1/products/1',
            {},
            {headers: new HttpHeaders({
                'x-access-token': this.x_access_token,
                'name': 'A3',
                'price': '20',
                'amount': '2'
            })}
        )
        .subscribe((res : any[]) => {
          console.log('Responce: ',res);
          this.responce = res && res.toString() || '';
        });
  }

  other() {
    this
        .httpClient
        .options(
            this.baseUrl+'api/v1/',
            {headers: new HttpHeaders({'x-access-token': this.x_access_token})}
        )
        .subscribe((res : any[]) => {
          console.log('Responce: ',res);
          this.responce = res && res.toString() || '';
        });
  }

  logOut() {
    this
        .httpClient
        .get(
            this.baseUrl+'api/v1/users/logout',
            {headers: new HttpHeaders({'x-access-token': this.x_access_token})}
        )
        .subscribe((res : any[]) => {
          console.log('Responce: ',res);
          this.responce = res && res.toString() || '';
        });
  }
}


