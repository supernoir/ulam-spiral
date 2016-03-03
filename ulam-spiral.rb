# ULAM SPIRAL
# 0.0.1

require 'prime'
require 'paint'

i = 1

for i in 1..600 do
 if Prime.prime?(i) == true
    print Paint["[#{i}]", :red]
    else
    print "[#{i}]"
 end
end


