/**
 * Create a function for vowel counter - Fellipe Anthony 01/08/23
 * github: sunwave1
 */

#include <iostream>
#include <vector>
#include <algorithm>
#include <memory>

class VowelCounter;

using VectorVowel = std::vector< char >; 
using VowelCounterPtr  = std::unique_ptr<VowelCounter>;

class VowelCounter {
	private:
		std::string word{ "" };
		VectorVowel vowel{ 'A', 'E', 'I', 'O', 'U', 'a', 'e', 'i', 'o', 'u' };
		int count { 0 };
		
	public: 
		VowelCounter(const std::string& word) : word(word) {};
		~VowelCounter() = default;
	
		VowelCounter(const VowelCounter&) = delete;
		VowelCounter& operator=(const VowelCounter&) = delete;
		
		const std::string& getWord() const {
			return word;
		}
		
		const VectorVowel& getVowels() const {
			return vowel;
		}
		
		void reset(const std::string& word) {
			this->word = word;
			count = 0;
		}
		
		int getCountVowels() {
			for (char w : word) {
			    auto it = std::find(vowel.begin(), vowel.end(), w);
			    if(it != vowel.end()){
			        count++;
			    }				
			}
			return count;
		}
		
};


int main() {

	std::string word{ "" };
    
    std::clog << "Insert a word for get a vowel counter!\n";
    std::cin >> word;
    
	VowelCounterPtr vwc = VowelCounterPtr(new VowelCounter( word ));
    
    int count = vwc->getCountVowels();
    
	std::clog << "The word \"" << word << "\" have a " << count << " vowel" << (count > 1 ? "s" : "") << "..\n";

	return EXIT_SUCCESS;
}