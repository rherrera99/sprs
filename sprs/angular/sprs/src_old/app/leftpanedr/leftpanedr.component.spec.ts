import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { LeftpanedrComponent } from './leftpanedr.component';

describe('LeftpanedrComponent', () => {
  let component: LeftpanedrComponent;
  let fixture: ComponentFixture<LeftpanedrComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ LeftpanedrComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(LeftpanedrComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
