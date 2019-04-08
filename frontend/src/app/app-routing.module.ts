import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {StudentComponent} from './student/student.component';
import {AppComponent} from './app.component';
import {SubmitComponent} from './submit/submit.component';

const routes: Routes = [
  {path: '', component: AppComponent},
  {path: 'student', component: StudentComponent},
  {path: 'submit', component: SubmitComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
