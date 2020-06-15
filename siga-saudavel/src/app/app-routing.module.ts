import { NgModule } from "@angular/core";
import { Routes, RouterModule } from "@angular/router";
import { FirstStepsComponent } from "./first-steps/first-steps.component";
import { FindRoutesComponent } from "./find-routes/find-routes.component";
import { GoalsComponent } from "./goals/goals.component";
import { PointsComponent } from "./points/points.component";
import { HealthComponent } from "./health/health.component";
import { MenuAppComponent } from "./menu-app/menu-app.component";
import { DetailsComponent } from './details/details.component';

const routes: Routes = [
    { path: "", component: FirstStepsComponent },
    {
        path: "app",
        component: MenuAppComponent,
        children: [
            { path: "rota", component: FindRoutesComponent },
            { path: "objetivos", component: GoalsComponent },
            { path: "pontos", component: PointsComponent },
            { path: "saude", component: HealthComponent }        ]
    },
    { path: "detalhes", component: DetailsComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}
