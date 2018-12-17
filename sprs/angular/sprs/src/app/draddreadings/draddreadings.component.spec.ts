import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DraddreadingsComponent } from './draddreadings.component';

describe('DraddreadingsComponent', () => {
  let component: DraddreadingsComponent;
  let fixture: ComponentFixture<DraddreadingsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DraddreadingsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DraddreadingsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
