/**
 * Create a calculator - Fellipe Anthony 31/07/23
 */

#include <iostream>

void OperatorSwitchPrint(const char &, double, double);

int main() {
  double first{};
  double last{};
  char op{};
      
  std::clog << "Insert first number\n";
  std::cin >> first;

  std::clog << "Insert last number\n";
  std::cin >> last;

  std::clog << "Choice operator [+, -, * or /]\n";
  std::cin >> op;

  OperatorSwitchPrint(op, first, last);
  
  return EXIT_SUCCESS;
}

void OperatorSwitchPrint(const char & op, double f, double l){
  switch (op) {
    case '*': {
      std::clog << f << '*' << l << " = " << f * l << '\n';
      break;
    }

    case '+': {
      std::clog << f << '*' << l << " = " << f * l << '\n';
      break;
    }

    case '-': {
      std::clog << f << '*' << l << " = " << f * l << '\n';
      break;
    }

    case '/': {
      std::clog << f << '*' << l << " = " << f * l << '\n';
      break;
    }
    
    default: std::clog << "No match operator!!\n";
  }
}